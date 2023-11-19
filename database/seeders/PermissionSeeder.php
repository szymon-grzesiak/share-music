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
        Permission::create(['name' => 'record_labels.index']);
        Permission::create(['name' => 'record_labels.manage']);

        // ADMINISTRATOR SYSTEMU
        $userRole = Role::findByName(config('auth.roles.admin'));
        $userRole->givePermissionTo('users.index');
        $userRole->givePermissionTo('users.store');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.change_role');
        $userRole->givePermissionTo('genres.index');
        $userRole->givePermissionTo('genres.manage');
//        $userRole->givePermissionTo('song.index');
//        $userRole->givePermissionTo('song.create');
//        $userRole->givePermissionTo('song.edit');
//        $userRole->givePermissionTo('song.destroy');
        $userRole->givePermissionTo('record_labels.index');
        $userRole->givePermissionTo('record_labels.manage');

        // ARTYSTA
        $userRole = Role::findByName(config('auth.roles.artist'));
        $userRole->givePermissionTo('genres.index');
//        $userRole->givePermissionTo('songs.index');
//        $userRole->givePermissionTo('song.create');
//        $userRole->givePermissionTo('song.edit');
//        $userRole->givePermissionTo('song.destroy');
        $userRole->givePermissionTo('record_labels.index');


        // UŻYTKOWNIKA SYSTEMU
        $userRole = Role::findByName(config('auth.roles.user'));
        $userRole->givePermissionTo('genres.index');
//        $userRole->givePermissionTo('songs.index');
//        $userRole->givePermissionTo('playlist.index');
//        $userRole->givePermissionTo('playlist.create');
//        $userRole->givePermissionTo('playlist.edit');
//        $userRole->givePermissionTo('playlist.destroy');
        $userRole->givePermissionTo('record_labels.index');


        // users, artists, albums, songs, genres, playlists
        // zapytać się czy albums może być - czy to jest słownik
        // może wydawnictwo muzyczne ale nie wiem
    }
}
