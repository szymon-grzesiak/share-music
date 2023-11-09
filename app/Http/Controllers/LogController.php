<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


class LogController extends Controller
{
    public function index()
    {

        $logFilePath = base_path('storage/logs/laravel.log');
        $logs = File::exists($logFilePath) ? explode("\n", File::get($logFilePath)) : [];

        return view('logs.index', ['logs' => $logs]);
    }
}
