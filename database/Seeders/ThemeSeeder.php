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
            'nom_theme' => 'Artificial Intelligence',
            'description' => 'Explore the future of machine learning and intelligent systems.',
        ]);
        Theme::create([
            'nom_theme' => 'Internet of Things (IoT)',
            'description' => 'Discover the world of connected devices and smart technology.',
        ]);
        Theme::create([
            'nom_theme' => 'Web Development',
            'description' => 'Learn to build modern, responsive, and scalable web applications.',
        ]);
        Theme::create([
            'nom_theme' => 'Data Science',
            'description' => 'Uncover insights from data to drive decision-making and innovation.',
        ]);
        Theme::create([
            'nom_theme' => 'Cybersecurity',
            'description' => 'Protect systems and networks from digital threats and attacks.',
        ]);
        Theme::create([
            'nom_theme' => 'Blockchain Technology',
            'description' => 'Understand decentralized systems and cryptocurrency technologies.',
        ]);
        Theme::create([
            'nom_theme' => 'Cloud Computing',
            'description' => 'Leverage cloud platforms for scalable and efficient computing.',
        ]);
        Theme::create([
            'nom_theme' => 'DevOps',
            'description' => 'Bridge development and operations for faster and reliable software delivery.',
        ]);
        Theme::create([
            'nom_theme' => 'Augmented Reality (AR)',
            'description' => 'Explore immersive technologies that blend the virtual and real world.',
        ]);
        Theme::create([
            'nom_theme' => 'Quantum Computing',
            'description' => 'Dive into the next generation of computing with quantum mechanics.',
        ]);
    }
}
