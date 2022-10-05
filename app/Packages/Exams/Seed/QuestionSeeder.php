<?php

namespace App\Packages\Exams\Seed;

use App\Packages\Exams\Model\Question;
use App\Packages\Exams\Model\Theme;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $themeRepository = EntityManager::getRepository(Theme::class);

        $mathematicsTheme = $themeRepository->findOneBy(['name' => 'Matemática']);
        $portugueseTheme = $themeRepository->findOneBy(['name' => 'Português']);

        $questionsSeeds = [
            ['theme' => $mathematicsTheme, 'description' => 'Em matemática, chamamos de "fator" um:'],
            ['theme' => $mathematicsTheme, 'description' => 'Qual dos objetos abaixo não possui forma esférica?'],
            ['theme' => $mathematicsTheme, 'description' => 'O que é o diâmetro?'],
            ['theme' => $mathematicsTheme, 'description' => 'Chamamos de eneágono um:'],
            ['theme' => $mathematicsTheme, 'description' => 'Em uma divisão, chamamos de "dividendo" o número:'],
            ['theme' => $portugueseTheme, 'description' => 'A palavra "latifúndio" está relacionada com:'],
            ['theme' => $portugueseTheme, 'description' => 'Uma loja que vende itens necessários à costura ou ao bordado (botão, linha, tecido, etc) é uma loja de:'],
            ['theme' => $portugueseTheme, 'description' => 'Notívago é aquele que...'],
            ['theme' => $portugueseTheme, 'description' => 'O coletivo de camelos é...'],
            ['theme' => $portugueseTheme, 'description' => 'Alentar é o mesmo que...'],
        ];

        foreach ($questionsSeeds as $questionSeed) {
            EntityManager::persist(new Question(
                $questionSeed['theme'],
                $questionSeed['description']
            ));
        }

        EntityManager::flush();
    }
}