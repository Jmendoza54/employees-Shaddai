<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'RH']);

        Permission::create(['name' => 'delete.employee'])->syncRoles([$role]);
        Permission::create(['name' => 'update.employee'])->syncRoles([$role, $role2]);
        Permission::create(['name' => 'view.employees'])->syncRoles([$role, $role2]);
        Permission::create(['name' => 'view.applied.codes'])->syncRoles([$role]);

        //$role->givePermissionTo($permission);
        //$permission->syncRoles($role);
    }
}