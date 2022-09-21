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
        $theme = $themeRepository->findOneBy(['name' => 'Matemática']);

        EntityManager::persist(new Question(
            $theme,
            'Um capital de C reais foi investido a juros compostos de 10% ao mês e gerou, em três meses, um montante de R$ 53240,00. Calcule o valor, em reais, do capital inicial C.'
        ));
        EntityManager::flush();
    }
}