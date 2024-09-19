<?php

namespace App\Singletons;


use Illuminate\Support\Facades\Http;

class SpotifyApiSingleton {
    private static $instance = null;
    private $response;

    private function __construct() {
        // 64LU4c1nfjz1t4VnGhagcg,6DEjYFkNZh67HP7R9PSZvv,6VgJZRUsCbR1NTnJWU85G4,0UtenXp3qVbWedKEaNRAp9,5mj5NblnMMm5G3n1cugGH7,4MwOuqjdK7OP1xaRPo83xT,4ocB97o3gdrIYyIwYSSwVy,3T4tUhGYeRNVUGevb0wThu,0vv1zKShlm7WuawEup5Mf4,6i7mF7whyRJuLJ4ogbH2wh,5Uly85dJHHDfHQCsyUQ8gw
        $this->response = Http::withHeaders([
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
            'X-RapidAPI-Key' => env('API_KEY')
        ])->get('https://spotify23.p.rapidapi.com/albums/?ids=18NOKLkZETa4sWwLMIm0UZ%2C41GuZcammIkupMPKH2OJ6I%2C2CIOGAByaHyjQ1EO55JSzC%2C3T4tUhGYeRNVUGevb0wThu%2C3DuiGV3J09SUhvp8gqNx8h%2C4MwOuqjdK7OP1xaRPo83xT');
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new SpotifyApiSingleton();
        }
        return self::$instance;
    }

    public function getResponse() {
        return $this->response->json();
    }
}
