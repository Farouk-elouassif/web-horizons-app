<?php
namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $themes = ['AI', 'IoT', 'Cloud Computing', 'Cybersecurity', 'Blockchain', 'Big Data', 'Machine Learning', 'Edge Computing', 'Quantum Computing', '5G Technology'];

        for ($i = 0; $i < 30; $i++) {
            DB::table('articles')->insert([
                'titre' => $faker->sentence(6),
                'contenu' => $faker->paragraphs(3, true),
                'statut' => $faker->randomElement(['Refusé', 'En cours', 'Retenu', 'Publié']),
                'date_proposition' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'theme_id' => $faker->numberBetween(6, 14),
                'user_id' => $faker->numberBetween(21, 24),
            ]);
        }
    }
}
