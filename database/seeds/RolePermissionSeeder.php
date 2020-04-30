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
        $superAdminRole = Role::create(['name' => 'Super admin']);
        $clientRole = Role::create(['name' => 'Client']);
        $viewAllItemspermission = Permission::create(['name' => 'view all items']);
        $clientRole->givePermissionTo($viewAllItemspermission);
    }
}
