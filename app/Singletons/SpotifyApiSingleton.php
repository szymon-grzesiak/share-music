<?php

namespace App\Singletons;


use Illuminate\Support\Facades\Http;

class SpotifyApiSingleton {
    private static $instance = null;
    private $response;

    private function __construct() {
        $this->response = Http::withHeaders([
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com',
            'X-RapidAPI-Key' => env('API_KEY')
        ])->get('https://spotify23.p.rapidapi.com/albums/?ids=64LU4c1nfjz1t4VnGhagcg%2C1NAmidJlEaVgA3MpcPFYGq%2C4MwOuqjdK7OP1xaRPo83xT%2C6VgJZRUsCbR1NTnJWU85G4%2C3zXjR3y2dUWklKmmp6lEhy%2C6lqE05fiHWJVYYdMVJNj38%2C2cWBwpqMsDJC1ZUwz813lo');
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
