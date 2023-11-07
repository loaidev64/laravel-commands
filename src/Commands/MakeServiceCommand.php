<?php

namespace LoaiDev64\LaravelCommands\Commands;

use Illuminate\Console\Command;
use LoaiDev64\LaravelCommands\Traits\CanManipulateFiles;

class MakeServiceCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'make:service {service}';

    public $description = 'Install route configuration and adding RouteHelper class';

    public function handle(): int
    {
        $this->copyStubToApp('service/ServiceClass', 'app/Services/'.$this->argument('service').'.php', [
            'namespace' => 'App\Services'.$this->argument('service'),
            'name' => $this->argument('service'),
        ]);

        $this->info('All done');

        return self::SUCCESS;
    }
}
