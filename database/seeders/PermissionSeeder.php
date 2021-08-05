<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view games']);
        Permission::create(['name' => 'create games']);
        Permission::create(['name' => 'edit games']);
        Permission::create(['name' => 'delete games']);

        // role viewer
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo('view games');

        // role writer
        $writer = Role::create(['name' => 'writer']);
        $writer->givePermissionTo('view games');
        $writer->givePermissionTo('create games');
        $writer->givePermissionTo('edit games');

        // role admin
        $admin = Role::create(['name' => 'admin']);

        $user = \App\Models\User::find(1);
        $user->assignRole($admin);
    }
}
