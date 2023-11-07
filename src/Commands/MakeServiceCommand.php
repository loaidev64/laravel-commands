<?php

namespace LoaiDev64\LaravelCommands\Commands;

use Illuminate\Console\Command;
use LoaiDev64\LaravelCommands\Traits\CanManipulateFiles;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'make:service {service}';

    public $description = 'Install route configuration and adding RouteHelper class';

    public function handle(): int
    {
        $this->copyStubToApp('service/ServiceClass', 'app/Services/' . $this->argument('service') . '.php', [
            'namespace' => 'App\Services' . str_replace('/', '\\', $this->argument('service')),
            'name' => Str::of($this->argument('service'))
                ->afterLast('/'),
        ]);

        $this->info('All done');

        return self::SUCCESS;
    }
}
