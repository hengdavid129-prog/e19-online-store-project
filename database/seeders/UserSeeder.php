<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role_id' => Role::where('name', 'admin')->value('id'),
                'firstname' => 'Heng',
                'lastname' => 'David',
                'email' => 'hengdavid@gmail.com',
                'phone' => '012345678',
                'password' => '1234567890'
            ],
            [
                'role_id' => Role::where('name', 'customer')->value('id'),
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'johndoe@gmail.com',
                'phone' => '011223344',
                'password' => '1234567890'
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
