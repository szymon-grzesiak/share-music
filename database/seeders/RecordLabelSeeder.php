<?php

namespace Database\Seeders;

use App\Models\RecordLabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecordLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecordLabel::factory()->count(50)->create();
    }
}
