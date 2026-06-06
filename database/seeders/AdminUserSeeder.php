<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmite.int'],
            [
                'name' => 'GMITE Admin Authority',
                'phone_number' => '+255000000',
                'country' => 'Global',
                'password' => Hash::make('@menard123'),
                'is_admin' => true,
            ]
        );
    }
}
