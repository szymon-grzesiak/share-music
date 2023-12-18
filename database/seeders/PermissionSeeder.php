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
        Permission::create(['name' => 'albums.index']);
        Permission::create(['name' => 'albums.manage']);
        Permission::create(['name' => 'albums.show']);
        Permission::create(['name' => 'songs.index']);
        Permission::create(['name' => 'songs.manage']);
        Permission::create(['name' => 'playlists.index']);
        Permission::create(['name' => 'playlists.manage']);
        Permission::create(['name' => 'playlists.songs']);


        // ADMINISTRATOR SYSTEMU
        $userRole = Role::findByName(config('auth.roles.admin'));
        $userRole->givePermissionTo('users.index');
        $userRole->givePermissionTo('users.store');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.change_role');
        $userRole->givePermissionTo('genres.index');
        $userRole->givePermissionTo('genres.manage');
        $userRole->givePermissionTo('songs.index');
        $userRole->givePermissionTo('songs.manage');
        $userRole->givePermissionTo('albums.index');
        $userRole->givePermissionTo('albums.manage');
        $userRole->givePermissionTo('albums.show');
        $userRole->givePermissionTo('playlists.index');
        $userRole->givePermissionTo('playlists.manage');
        $userRole->givePermissionTo('playlists.songs');

        // ARTYSTA
        $userRole = Role::findByName(config('auth.roles.artist'));
        $userRole->givePermissionTo('genres.index');
        $userRole->givePermissionTo('songs.index');
        $userRole->givePermissionTo('songs.manage');
        $userRole->givePermissionTo('albums.index');

        // UŻYTKOWNIKA SYSTEMU
        $userRole = Role::findByName(config('auth.roles.user'));
//        $userRole->givePermissionTo('genres.index');
        $userRole->givePermissionTo('albums.index');
        $userRole->givePermissionTo('songs.index');
        $userRole->givePermissionTo('playlists.index');
//        $userRole->givePermissionTo('songs.index');
//        $userRole->givePermissionTo('playlist.index');
//        $userRole->givePermissionTo('playlist.create');
//        $userRole->givePermissionTo('playlist.edit');
//        $userRole->givePermissionTo('playlist.destroy');

    }
}
