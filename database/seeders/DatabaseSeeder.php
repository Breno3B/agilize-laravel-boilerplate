<?php

namespace Database\Seeders;


 use App\Packages\Exams\Seed\QuestionSeeder;
 use App\Packages\Exams\Seed\ThemeSeeder;
 use App\Packages\Student\Seed\StudentSeeder;
 use Illuminate\Database\Seeder;

 class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                StudentSeeder::class,
                ThemeSeeder::class,
                QuestionSeeder::class,
            ]
        );
    }
}