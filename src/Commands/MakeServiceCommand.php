<?php

namespace LoaiDev64\LaravelCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use LoaiDev64\LaravelCommands\Traits\CanManipulateFiles;

class MakeServiceCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'make:service {service}';

    public $description = 'Install route configuration and adding RouteHelper class';

    public function handle(): int
    {
        $this->copyStubToApp('service/ServiceClass', 'app/Services/'.$this->argument('service').'.php', [
            'namespace' => 'App\Services\\'.Str::of(str_replace('/', '\\', $this->argument('service')))->beforeLast('\\'),
            'name' => Str::of($this->argument('service'))
                ->afterLast('/'),
        ]);

        $this->info('All done');

        return self::SUCCESS;
    }
}
