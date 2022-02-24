<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role management
        $moduleRoleUser = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleRoleUser->id,
            'name' => 'Access Role',
            'slug' => 'roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleRoleUser->id,
            'name' => 'Create User',
            'slug' => 'roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleRoleUser->id,
            'name' => 'Update User',
            'slug' => 'roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleRoleUser->id,
            'name' => 'Delete User',
            'slug' => 'roles.destroy',
        ]);
    }
}
