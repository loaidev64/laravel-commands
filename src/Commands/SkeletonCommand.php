<?php

namespace VendorName\Skeleton\Commands;

use Illuminate\Console\Command;

class SkeletonCommand extends Command
{
    public $signature = 'role:install';

    public $description = 'Install role configuration';

    public function handle(): int
    {
        $roleModel = '<?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
        
        class Role extends Model
        {
            use HasFactory;
        
            public $timestamps = false;
        }
        
    ';
        $this->file_force_contents('app/Models/Role.php', $roleModel);
        $this->info('Controller has been created: app/Models/Role.php');

        $roleMigration = '<?php
        
        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        
        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create("roles", function (Blueprint $table) {
                    $table->id();
                    $table->string("name");
                });
            }
        
            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists("roles");
            }
        };
        
    ';
        $this->file_force_contents('database/migrations/2023_06_23_161522_create_roles_table.php', $roleMigration);
        $this->info('Controller has been created: database/migrations/2023_06_23_161522_create_roles_table.php');

        $roleIdMigration = '<?php
        
        use App\Models\Role;
        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::table("users", function (Blueprint $table) {
                    $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::table("users", function (Blueprint $table) {
                    //
                });
            }
            
    ';
        $this->file_force_contents('database/migrations/2023_06_23_164919_add_role_id_to_users.php', $roleIdMigration);
        $this->info('Controller has been created: database/migrations/2023_06_23_164919_add_role_id_to_users.php');

        $roleSeeder = '<?php
        
        namespace Database\Seeders;

        use App\Models\Role;
        use Illuminate\Database\Seeder;

        class RoleSeeder extends Seeder
        {
            /**
             * Run the database seeds.
             */
            public function run(): void
            {
                Role::create([
                    "name" => "admin",
                ]);

                Role::create([
                    "name" => "user",
                ]);
            }
        }

    ';
        $this->file_force_contents('database/seeders/RoleSeeder.php', $roleSeeder);
        $this->info('Controller has been created: database/seeders/RoleSeeder.php');

        $adminSeeder = '<?php
        
        namespace Database\Seeders;

        use App\Models\User;
        use Illuminate\Database\Seeder;
        
        class AdminSeeder extends Seeder
        {
            /**
             * Run the database seeds.
             */
            public function run(): void
            {
                User::factory()->create([
                    "name" => "admin",
                    "email" => "admin@admin.com",
                    "role_id" => 1,
                ]);
            }
        }
        

    ';

        $this->replace_in_file(
            'database/factories/UserFactory.php',
            [
                '];
                }
                
                /**' => '
                 "role_id" => 2,
                 ];
                }
                
                /**',
            ]
        );

        $this->replace_in_file(
            'database/seeders/DatabaseSeeder.php',
            [
                '];
            }
            ' => '];

            function role(): BelongsTo
            {
                return $this->belongsTo(Role::class);
            }
        }',
            ]
        );

        $this->file_force_contents('database/seeders/AdmineSeeder.php', $adminSeeder);
        $this->info('Controller has been created: database/seeders/AdmineSeeder.php');

        $this->comment('All done');

        return self::SUCCESS;
    }

    private function file_force_contents($fullPath, $contents, $flags = 0)
    {
        $parts = explode('/', $fullPath);
        array_pop($parts);
        $dir = implode('/', $parts);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($fullPath, $contents, $flags);
    }

    public function replace_in_file(string $file, array $replacements): void
    {
        $contents = file_get_contents($file);

        file_put_contents(
            $file,
            str_replace(
                array_keys($replacements),
                array_values($replacements),
                $contents
            )
        );
    }
}
