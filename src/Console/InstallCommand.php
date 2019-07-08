<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

/**
 * Credits: laravel/telescope.
 */
class InstallCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabels:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Larabels resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->comment('Publishing Larabels Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'larabels-provider']);

        $this->comment('Publishing Larabels Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'larabels-assets']);

        $this->comment('Publishing Larabels Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'larabels-config']);

        $this->registerLarabelsServiceProvider();

        $this->info('Larabels scaffolding installed successfully.');
    }

    /**
     * Register the Larabels service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerLarabelsServiceProvider(): void
    {
        $namespace = str_replace_last('\\', '', $this->getAppNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\LarabelsServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol,
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol."        {$namespace}\Providers\LarabelsServiceProvider::class,".$eol,
            $appConfig
        ));

        file_put_contents(app_path('Providers/LarabelsServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/LarabelsServiceProvider.php'))
        ));
    }
}
