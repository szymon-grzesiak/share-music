<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);
        Permission::create(['name' => 'genres.index']);
        Permission::create(['name' => 'genres.manage']);

        $userRole = Role::findByName(config('auth.roles.admin'));
        $userRole->givePermissionTo('users.index');
        $userRole->givePermissionTo('users.store');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.change_role');
    }
}
