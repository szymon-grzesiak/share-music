<?php

namespace Database\Seeders;

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

        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
            'X-RapidAPI-Key' => '34968fee8dmsh13a083a76c74fc3p1870b2jsn57c8dae9b6a0'
        ])->get('https://spotify23.p.rapidapi.com/albums/?ids=64LU4c1nfjz1t4VnGhagcg%2C1NAmidJlEaVgA3MpcPFYGq%2C4MwOuqjdK7OP1xaRPo83xT%2C6VgJZRUsCbR1NTnJWU85G4%2C3zXjR3y2dUWklKmmp6lEhy%2C6lqE05fiHWJVYYdMVJNj38%2C2cWBwpqMsDJC1ZUwz813lo');

        $data = $response->json();

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
