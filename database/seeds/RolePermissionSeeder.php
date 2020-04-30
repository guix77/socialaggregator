<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Permission::create(['name' => 'create user']);
        $clientRole = Role::create(['name' => 'client']);
        $viewAllItemspermission = Permission::create(['name' => 'view all items']);
        $clientRole->givePermissionTo($viewAllItemspermission);
    }
}
