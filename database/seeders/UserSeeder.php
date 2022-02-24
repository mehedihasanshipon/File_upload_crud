<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Create admin
         $admin=User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'status' => true,
            'role_id' => 1,
        ]);
        // $admin->roles()->sync([1]);

        // Create user
        $user=User::updateOrCreate([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
            'status' => true,
            'role_id' => 2,
        ]);
        // $user->roles()->sync([2]);
    }
}
