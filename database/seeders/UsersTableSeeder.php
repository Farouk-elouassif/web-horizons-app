<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nom' => 'Zakaria Ouchouch',
                'email' => 'ouhchouch@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'Responsable de thème',
                'date_inscription' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'amine Ouchouch',
                'email' => 'amine@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'Abonné',
                'date_inscription' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Saad El Ouassif',
                'email' => 'saad@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'Responsable de thème',
                'date_inscription' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],



        ]);
    }
}
