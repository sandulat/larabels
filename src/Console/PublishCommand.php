<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Console;

use Illuminate\Console\Command;

/**
 * Credits: laravel/telescope.
 */
final class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabels:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the Larbels resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'larabels-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'larabels-assets',
            '--force' => true,
        ]);
    }
}
