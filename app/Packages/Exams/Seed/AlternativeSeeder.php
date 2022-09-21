<?php

namespace App\Packages\Exams\Seed;

use App\Packages\Exams\Model\Alternative;
use App\Packages\Exams\Model\Question;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $questionRepository = EntityManager::getRepository(Question::class);
        $question = $questionRepository->findOneBy(
            ['description' => 'Um capital de C reais foi investido a juros compostos de 10% ao mês e gerou, em três meses, um montante de R$ 53240,00. Calcule o valor, em reais, do capital inicial C.']
        );

        $alternatives = [
            ['description' => 'C = 40.000,00', 'isCorrect' => true],
            ['description' => 'C = 50.000,00', 'isCorrect' => false],
            ['description' => 'C = 60.000,00', 'isCorrect' => false],
            ['description' => 'C = 70.000,00', 'isCorrect' => false],
        ];

        foreach ($alternatives as $alternative) {
            EntityManager::persist(new Alternative(
                $question,
                $alternative['description'],
                $alternative['isCorrect']
            ));
        }

        EntityManager::flush();
    }
}