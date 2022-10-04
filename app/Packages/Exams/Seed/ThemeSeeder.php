<?php

namespace App\Packages\Exams\Seed;

use App\Packages\Exams\Model\Theme;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $themesSeeds = [
            ['name' => 'Matemática', 'description' => 'O tema Matemática inclui questões de cálculo, geometria, trigonometria, estatística, álgebra, funções, etc.'],
            ['name' => 'Português', 'description' => 'O tema Português inclui questões de ortografia, gramática, sintaxe, semântica, etc.'],
            ['name' => 'História', 'description' => 'O tema História inclui questões de história do Brasil, história geral, história da arte, história da música, história da filosofia, etc.'],
            ['name' => 'Geografia', 'description' => 'O tema Geografia inclui questões de geografia do Brasil, geografia geral, geografia física, geografia humana, etc.'],
            ['name' => 'Biologia', 'description' => 'O tema Biologia inclui questões de biologia geral, biologia celular, biologia molecular, biologia vegetal, biologia animal, etc.'],
            ['name' => 'Física', 'description' => 'O tema Física inclui questões de física geral, física quântica, física clássica, física moderna, física experimental, etc.'],
            ['name' => 'Química', 'description' => 'O tema Química inclui questões de química geral, química orgânica, química inorgânica, química analítica, química física, etc.'],
            ['name' => 'Sociologia', 'description' => 'O tema Sociologia inclui questões de sociologia geral, sociologia do trabalho, sociologia urbana, sociologia rural, sociologia da educação, etc.'],
            ['name' => 'Filosofia', 'description' => 'O tema Filosofia inclui questões de filosofia geral, filosofia da natureza, filosofia da mente, filosofia da religião, filosofia da ética, etc.'],
            ['name' => 'Inglês', 'description' => 'O tema Inglês inclui questões de inglês geral, inglês técnico, inglês comercial, inglês jurídico, inglês médico, etc.'],
            ['name' => 'Espanhol', 'description' => 'O tema Espanhol inclui questões de espanhol geral, espanhol técnico, espanhol comercial.']
        ];

        foreach ($themesSeeds as $themeSeed) {
            EntityManager::persist(new Theme($themeSeed['name'], $themeSeed['description']));
        }

        EntityManager::flush();
    }
}