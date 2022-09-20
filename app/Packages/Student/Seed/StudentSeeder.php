<?php

namespace App\Packages\Student\Seed;


use App\Packages\Student\Model\Student;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class StudentSeeder
 */
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        EntityManager::persist(new Student('Breno Rodrigues'));

        EntityManager::flush();
    }
}