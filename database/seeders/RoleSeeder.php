<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        Role::updateOrCreate([
            'name'=>'Admin',
            'slug'=>Str::slug('admin')
        ])->permissions()->sync($permissions->pluck('id'));

        Role::updateOrCreate([
            'name'=>'User',
            'slug'=>Str::slug('user')
        ]);
    }
}
