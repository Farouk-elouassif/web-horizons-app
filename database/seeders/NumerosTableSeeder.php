<?php
namespace Database\Seeders;
use App\Models\Numero;
use Illuminate\Database\Seeder;

class NumerosTableSeeder extends Seeder
{
    public function run()
    {
        Numero::create([
            'titre_numero' => 'Numero 1',
            'date_publication' => '2025-01-18',
            'statut' => 'Publié'
        ]);

        Numero::create([
            'titre_numero' => 'Numero 2',
            'date_publication' => '2025-01-19',
            'statut' => 'Publié'
        ]);

        Numero::create([
            'titre_numero' => 'Numero 3',
            'date_publication' => '2025-01-20',
            'statut' => 'Publié'
        ]);


    }
}
