<?php

namespace Database\Seeders;

use App\Singletons\SpotifyApiSingleton;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $admin = User::create([
            'name' => 'Administrator Testowy',
            'email' => 'admin.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        $adminRole = Role::findByName(config('auth.roles.admin'));
        if (isset($adminRole)) {
            $admin->assignRole($adminRole);
        }

        $artistRole = Role::findByName(config('auth.roles.artist'));

        $artist1 = User::create([
            'name' => 'Artysta Testowy',
            'email' => 'artist.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        if (isset($artistRole)) {
            $artist1->assignRole($artistRole);
        }

        $artist2 = User::create([
            'name' => 'Artysta Testowy 2',
            'email' => 'artist2.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        if (isset($artistRole)) {
            $artist2->assignRole($artistRole);
        }

        $artist3 = User::create([
            'name' => 'Artysta Testowy 3',
            'email' => 'artist3.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        if (isset($artistRole)) {
            $artist3->assignRole($artistRole);
        }

       $data = SpotifyApiSingleton::getInstance()->getResponse();

        foreach ($data['albums'] as $albumData) {
            foreach ($albumData['artists'] as $artistData) {
                $artistName = $albumData['artists'][0]['name']; // Assuming the first artist

                $artistUser = User::firstOrCreate(
                    ['email' => strtolower(str_replace(' ', '.', $artistName)) . '@localhost'],
                       [ 'name' => $artistData['name'],
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make('12345678'),
                    ]
                );
                $artistRole = Role::where('name', 'artist')->first();
                if ($artistRole) {
                    $artistUser->assignRole($artistRole);
                }
            }
        }



        $user = User::create([
            'name' => 'Użytkownik Testowy',
            'email' => 'user.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        $userRole = Role::findByName(config('auth.roles.user'));
        if (isset($userRole)) {
            $user->assignRole($userRole);
        }
    }
}
