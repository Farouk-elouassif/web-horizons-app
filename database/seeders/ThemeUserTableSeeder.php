<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Theme;


class ThemeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with the role "Responsable de Theme"
        $users = User::where('role', 'Responsable de Theme')->get();

        // Get themes with IDs between 6 and 14
        $themes = Theme::whereBetween('id', [6, 14])->get();

        // Assign themes to users
        foreach ($users as $user) {
            // Randomly assign 1 to 3 themes to each user
            $user->themes()->attach(
                $themes->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
