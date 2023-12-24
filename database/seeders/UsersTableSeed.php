<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'hasan jasser',
            'email'=>'hasan@gmail.com',
            'password'=>bcrypt('12345678')
        ]);

        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('12345678')
        ]);

        User::create([
            'name'=>'super admin',
            'email'=>'superadmin@gmail.com',
            'password'=>bcrypt('12345678')
        ]);
    }
}
