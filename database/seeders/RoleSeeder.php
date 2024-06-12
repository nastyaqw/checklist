<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $checklistManager = Role::create(['name' => 'Checklist Manager']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-checklist',
            'edit-checklist',
            'delete-checklist'
        ]);

        $checklistManager->givePermissionTo([
            'create-checklist',
            'edit-checklist',
            'delete-checklist'
        ]);
    }
}
