<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $writerRole = Role::firstOrCreate(['name' => 'Writer']);

        Permission::firstOrCreate(['name' => 'Create News']);
        Permission::firstOrCreate(['name' => 'Store News']);
        Permission::firstOrCreate(['name' => 'Edit News']);
        Permission::firstOrCreate(['name' => 'Update News']);
        Permission::firstOrCreate(['name' => 'Status News']);
        Permission::firstOrCreate(['name' => 'Update Status News']);
        Permission::firstOrCreate(['name' => 'Draft']);

        $writerRole->givePermissionTo(['Create News', 'Store News', 'Edit News', 'Update News', 'Draft']);
        $editorRole->givePermissionTo(['Status News', 'Update Status News']);
        $permissions = Permission::pluck('id')->all();
        $superAdminRole->syncPermissions($permissions);

        $superAdmin1 = User::firstOrCreate([
            'email' => 'sela168@gmail.com'
        ], [
            'name' => 'Admin',
            'password' => bcrypt('adminsela168')
        ]);
        $superAdmin1->assignRole($superAdminRole);

        $superAdmin2 = User::firstOrCreate([
            'email' => 'layheang168@gmail.com'
        ], [
            'name' => 'Admin',
            'password' => bcrypt('adminheang168')
        ]);
        $superAdmin2->assignRole($superAdminRole);
    }
}
