<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Domain;

use Cz\Git\GitRepository as GitRepo;
use Illuminate\Support\Str;

final class GitRepository extends GitRepo
{
    /**
     * Check if the given path has been changed.
     *
     * @param string $path
     * @return boolean
     */
    public function pathHasChanges(string $path): bool
    {
        $this->begin()
            ->run('git update-index -q --refresh')
            ->end();

        $output = collect($this->extractFromCommand('git status --porcelain'));

        return $output->some(static function ($item) use ($path) {
            return Str::contains($item, $path);
        });
    }
}
