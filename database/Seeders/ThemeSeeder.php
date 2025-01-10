<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::create([
            'nom_theme' => 'ai',
            'description' => 'ai des',
        ]);
        Theme::create([
            'nom_theme' => 'iot',
            'description' => 'iot des',
        ]);
        Theme::create([
            'nom_theme' => 'web dev',
            'description' => 'web dev des',
        ]);
        Theme::create([
            'nom_theme' => 'data science',
            'description' => 'data science des',
        ]);
    }
}
