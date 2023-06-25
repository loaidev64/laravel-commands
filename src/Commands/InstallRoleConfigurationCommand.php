<?php

namespace LoaiDev64\LaravelCommands\Commands;

use Illuminate\Console\Command;
use LoaiDev64\LaravelCommands\Traits\CanManipulateFiles;

class InstallRoleConfigurationCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'role:install {--auth}';

    public $description = 'Install role configuration';

    public function handle(): int
    {
        $this->copyStubToApp('role/Role', 'app/Models/Role.php');

        $this->copyStubToApp('role/RoleMigration', 'database/migrations/2023_06_23_161522_create_roles_table.php');

        $this->copyStubToApp('role/RoleIdInUsersTableMigration', 'database/migrations/2023_06_23_164919_add_role_id_to_users.php');

        $this->copyStubToApp('role/RoleSeeder', 'database/seeders/RoleSeeder.php');

        $this->copyStubToApp('role/AdminSeeder', 'database/seeders/AdminSeeder.php');

        $this->copyStubToApp('role/DatabaseSeeder', 'database/seeders/DatabaseSeeder.php');

        $this->copyStubToApp('role/HasRole', 'app/Traits/HasRole.php');

        $this->copyStubToApp('role/HasRoleMiddleware', 'app/Http/Middleware/HasRoleMiddleware.php');

        $this->warn('add role relationship, and HasRole trait to app/Models/User.php');

        $this->warn('add middleware alias to app/Http/Kernel.php');

        if ($this->option('auth')) {

            $this->copyStubToApp('role/RegisterationRoutes', 'routes/api/v1/auth.php');

            $this->warn('add auth file to routes/api.php');

            $this->copyStubToApp('role/LoginRequest', 'app/Http/Requests/Api/V1/Auth/LoginRequest.php');

            $this->copyStubToApp('role/LoginRequest', 'app/Http/Requests/Api/V1/Auth/LoginRequest.php');

            $this->copyStubToApp('role/RegisterationController', 'app/Http/Controllers/Api/V1/Auth/RegisterationController.php');
        }

        $this->info('All done');

        return self::SUCCESS;
    }
}
