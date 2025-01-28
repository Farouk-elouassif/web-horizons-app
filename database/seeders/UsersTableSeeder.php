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
     * 
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nom' => 'saad mime',
                'email' => 'mime@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'Éditeur',
                'date_inscription' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]



        ]);
    }
}
