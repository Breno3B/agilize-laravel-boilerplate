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
        EntityManager::persist(new Theme(
            'Matemática',
            'O tema Matemática inclui questões de cálculo, geometria, trigonometria, estatística, álgebra, funções, etc.'
        ));
        EntityManager::flush();
    }
}