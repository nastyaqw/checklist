<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Nastya Super', 
            'email' => 'nastya@admin.com',
            'password' => Hash::make('admin1')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Ivan Admin', 
            'email' => 'ivan@admin.com',
            'password' => Hash::make('admin2')
        ]);
        $admin->assignRole('Admin');

        // Creating Checklist Manager User
        $checklistManager = User::create([
            'name' => 'Elena User', 
            'email' => 'elena@user.com',
            'password' => Hash::make('user1')
        ]);
        $checklistManager->assignRole('Checklist Manager');
    }
}