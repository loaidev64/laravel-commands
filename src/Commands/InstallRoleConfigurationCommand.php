<?php

namespace VendorName\Skeleton\Commands;

use Illuminate\Console\Command;
use VendorName\Skeleton\Traits\CanManipulateFiles;

class InstallRoleConfigurationCommand extends Command
{
    use CanManipulateFiles;

    public $signature = 'role:install';

    public $description = 'Install role configuration';

    public function handle(): int
    {
        $this->copyStubToApp('role/Role', 'app/Models/Role.php');

        $this->copyStubToApp('role/RoleMigration', 'database/migrations/2023_06_23_161522_create_roles_table.php');

        $this->copyStubToApp('role/RoleIdInUsersTableMigration', 'database/migrations/2023_06_23_164919_add_role_id_to_users.php');

        $this->copyStubToApp('role/RoleSeeder', 'database/seeders/RoleSeeder.php');

        $this->copyStubToApp('role/AdminSeeder', 'database/seeders/AdminSeeder.php');

        $this->copyStubToApp('role/DatabaseSeeder', 'database/seeders/DatabaseSeeder.php');

        $this->warn('add role relationship in app/Models/User.php');

        $this->comment('All done');

        return self::SUCCESS;
    }
}
