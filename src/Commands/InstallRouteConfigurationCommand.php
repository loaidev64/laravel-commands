<?php

namespace LoaiDev64\LaravelCommands\Commands;

use Illuminate\Console\Command;
use LoaiDev64\LaravelCommands\Traits\CanManipulateFiles;

class InstallRouteConfigurationCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'route:install';

    public $description = 'Install route configuration and adding RouteHelper class';

    public function handle(): int
    {
        $this->copyStubToApp('route/RouteHelper', 'app/Helpers/RouteHelper.php');

        $this->copyStubToApp('route/api', 'routes/api.php');

        $this->copyStubToApp('route/web', 'routes/web.php');

        $this->info('All done');

        return self::SUCCESS;
    }
}
