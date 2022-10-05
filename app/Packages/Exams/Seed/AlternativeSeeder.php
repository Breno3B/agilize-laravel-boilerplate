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

        $mathematicsQuestion_1 = $questionRepository->findOneBy(['description' => 'Em matemática, chamamos de "fator" um:']);
        $mathematicsQuestion_2 = $questionRepository->findOneBy(['description' => 'Qual dos objetos abaixo não possui forma esférica?']);
        $mathematicsQuestion_3 = $questionRepository->findOneBy(['description' => 'O que é o diâmetro?']);
        $mathematicsQuestion_4 = $questionRepository->findOneBy(['description' => 'Chamamos de eneágono um:']);
        $mathematicsQuestion_5 = $questionRepository->findOneBy(['description' => 'Em uma divisão, chamamos de "dividendo" o número:']);

        $alternativesSeeds = [
            ['question' => $mathematicsQuestion_1, 'description' => 'número que é somado a outro', 'correct' => false],
            ['question' => $mathematicsQuestion_1, 'description' => 'número ou elemento submetido à operação de multiplicação', 'correct' => true],
            ['question' => $mathematicsQuestion_1, 'description' => 'valor usado como denominador de uma fração', 'correct' => false],
            ['question' => $mathematicsQuestion_1, 'description' => 'número inteiro maior que zero', 'correct' => false],
            ['question' => $mathematicsQuestion_1, 'description' => 'número negativo qualquer', 'correct' => false],
            ['question' => $mathematicsQuestion_2, 'description' => 'bola de futebol', 'correct' => false],
            ['question' => $mathematicsQuestion_2, 'description' => 'bola de vôlei', 'correct' => false],
            ['question' => $mathematicsQuestion_2, 'description' => 'bola de tênis', 'correct' => false],
            ['question' => $mathematicsQuestion_2, 'description' => 'bola de ping pong', 'correct' => false],
            ['question' => $mathematicsQuestion_2, 'description' => 'bola de futebol americano', 'correct' => true],
            ['question' => $mathematicsQuestion_3, 'description' => 'o mesmo que metro quadrado', 'correct' => false],
            ['question' => $mathematicsQuestion_3, 'description' => 'medida da diagonal de um retângulo', 'correct' => false],
            ['question' => $mathematicsQuestion_3, 'description' => 'segmento de reta que passa pelo centro e que une dois pontos da circunferência do círculo', 'correct' => true],
            ['question' => $mathematicsQuestion_3, 'description' => 'medida equivalente à metade do raio de uma circunferência', 'correct' => false],
            ['question' => $mathematicsQuestion_3, 'description' => 'um conjunto com 10 números inteiros', 'correct' => false],
            ['question' => $mathematicsQuestion_4, 'description' => 'quilo de cimento', 'correct' => false],
            ['question' => $mathematicsQuestion_4, 'description' => 'gráfico tridimensional', 'correct' => false],
            ['question' => $mathematicsQuestion_4, 'description' => 'conjunto de n números', 'correct' => false],
            ['question' => $mathematicsQuestion_4, 'description' => 'polígono de n lados', 'correct' => false],
            ['question' => $mathematicsQuestion_4, 'description' => 'polígono de 9 lados', 'correct' => true],
            ['question' => $mathematicsQuestion_5, 'description' => 'que é o resultado da operação', 'correct' => false],
            ['question' => $mathematicsQuestion_5, 'description' => 'pelo qual iremos dividir', 'correct' => false],
            ['question' => $mathematicsQuestion_5, 'description' => 'que será multiplicado', 'correct' => false],
            ['question' => $mathematicsQuestion_5, 'description' => 'que será dividido', 'correct' => true],
            ['question' => $mathematicsQuestion_5, 'description' => 'nenhuma das alternativas', 'correct' => false],
        ];

        foreach ($alternativesSeeds as $alternativeSeed) {
            EntityManager::persist(new Alternative(
                $alternativeSeed['question'],
                $alternativeSeed['description'],
                $alternativeSeed['correct']
            ));
        }

        EntityManager::flush();
    }
}