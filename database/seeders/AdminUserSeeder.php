<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Peka',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'phone' => '08983368286',
            'password' => bcrypt('123456'),
        ]);
    }
}
