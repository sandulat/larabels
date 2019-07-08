<?php

declare(strict_types=1);

namespace Sandulat\Larabels;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Sandulat\Larabels\Domain\Label;
use Illuminate\Filesystem\Filesystem;
use Zend\Code\Generator\FileGenerator;
use Sandulat\Larabels\Domain\Container;
use Zend\Code\Generator\ValueGenerator;
use Symfony\Component\Finder\SplFileInfo;
use Sandulat\Larabels\Domain\GitRepository;

final class Larabels
{
    use AuthorizesRequests;

    /**
     * Locales path.
     *
     * @var string
     */
    private static $localesPath;

    /**
     * GIT repository.
     *
     * @var \Sandulat\Larabels\Domain\GitRepository
     */
    private static $repository;

    /**
     * Create a new Larabels instance.
     */
    public function __construct()
    {
        static::$localesPath = App::resourcePath('lang');

        static::$repository = new GitRepository(App::basePath());
    }

    /**
     * Returns parsed labels.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function labels(): Collection
    {
        return static::directories()->mapWithKeys(
            static function ($path) {
                $locale = static::lastDirectoryName($path);

                return [
                    $locale => static::files($path)->mapWithKeys(
                        static function (SplFileInfo $file) use ($path, $locale) {
                            return [
                                $file->getFilenameWithoutExtension() => static::fileLabels($file, $path, $locale),
                            ];
                        }
                    ),
                ];
            }
        );
    }

    /**
     * Returns all the directories from locales path.
     *
     * @return \Illuminate\Support\Collection
     */
    private static function directories(): Collection
    {
        return collect((new Filesystem)->directories(static::$localesPath));
    }

    /**
     * Returns all the files from the given path.
     *
     * @param string $path
     * @return \Illuminate\Support\Collection
     */
    private static function files(string $path): Collection
    {
        $files = collect((new Filesystem)->files($path));

        $whitelist = config('larabels.whitelist');

        if (! empty($whitelist)) {
            return $files->filter(
                static function (SplFileInfo $file) use ($whitelist) {
                    return in_array($file->getFilenameWithoutExtension(), $whitelist);
                }
            );
        }

        return $files;
    }

    /**
     * Returns all the files from the given path.
     *
     * @param \Symfony\Component\Finder\SplFileInfo $file
     * @param string $path
     * @param string $locale
     * @return \Illuminate\Support\Collection
     */
    private static function fileLabels(SplFileInfo $file, string $path, string $locale): Collection
    {
        $items = include $path.'/'.$file->getFilename();

        return (new Collection($items))->map(
            static function ($item, $key) use ($file, $locale) {
                $fileName = $locale.'.'.$file->getFilenameWithoutExtension();

                if (is_string($item)) {
                    return new Label($item, $key, $fileName);
                }

                return new Container($item, $key, $fileName);
            }
        );
    }

    /**
     * Returns the last directory name from a path.
     *
     * @param string $path
     * @return string
     */
    private static function lastDirectoryName(string $path): string
    {
        $directories = explode('/', $path);

        return end($directories);
    }

    /**
     * Exports locale labels.
     *
     * @param string $locale
     * @param array $files
     * @return void
     */
    public function exportLabels(string $locale, array $files): void
    {
        collect($files)->each(static function ($labels, $file) use ($locale) {
            $exportPath = static::$localesPath.'/'.$locale.'/'.$file.'.php';

            $exportFile = FileGenerator::fromArray([
                'body' => 'return '.(new ValueGenerator($labels))->generate().';'.PHP_EOL,
            ]);

            (new Filesystem)->put($exportPath, $exportFile->generate());
        });
    }

    /**
     * Check if labels where changed.
     *
     * @param string $locale
     * @param array $files
     * @return void
     */
    public function labelsHaveChanges(): bool
    {
        return static::$repository->pathHasChanges('resources/lang');
    }

    /**
     * Checkout labels.
     *
     * @return \Sandulat\Larabels\Domain\GitRepository
     */
    public function checkoutLabels(): GitRepository
    {
        return tap(static::$repository, static function (GitRepository $repository) {
            $repository->execute(['checkout', 'resources/lang']);

            $repository->execute(['reset', 'resources/lang']);
        });
    }

    /**
     * Commit the changes.
     *
     * @return \Sandulat\Larabels\Domain\GitRepository
     */
    public function commit(): GitRepository
    {
        if (! $this->labelsHaveChanges()) {
            return static::$repository;
        }

        return tap(static::$repository, static function (GitRepository $repository) {
            $repository->addFile('resources/lang');

            $repository->commit(__('Updated labels.'));

            $repository->push('origin', ['HEAD']);
        });
    }
}
