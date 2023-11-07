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
        $this->copyStubToApp('route/RouteHelper', 'app/Helpers/Route/RouteHelper.php');

        $this->copyStubToApp('route/api', 'routes/api.php');

        $this->copyStubToApp('route/web', 'routes/web.php');

        $this->createDirectory('routes/api');

        $this->createDirectory('routes/api/v1');

        $this->createDirectory('routes/web');

        $this->info('All done');

        $this->info('Now you can add api routes files in routes/api/v1 folder and they will magically be imported in routes');

        $this->info('Now you can add web routes files in routes/web folder and they will magically be imported in routes');

        return self::SUCCESS;
    }
}
