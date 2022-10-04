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
            [
                'theme' => $mathematicsTheme,
                'description' => '(UERJ/2017) Um capital de C reais foi investido a juros compostos de 10% ao mês e gerou, em três meses, um montante de R$ 53240,00. Calcule o valor, em reais, do capital inicial C.',
            ],
            [
                'theme' => $mathematicsTheme,
                'description' => '(UNESP/2005) Mário tomou um empréstimo de R$ 8.000,00 a juros de 5% ao mês. Dois meses depois, Mário pagou R$ 5.000,00 do empréstimo e, um mês após esse pagamento, liquidou todo o seu débito. O valor do último pagamento foi de:',
            ],
            [
                'theme' => $mathematicsTheme,
                'description' => '(PUC-RJ/2000) Um banco pratica sobre o seu serviço de cheque especial a taxa de juros de 11% ao mês. Para cada 100 reais de cheque especial, o banco cobra 111 no primeiro mês, 123,21 no segundo, e assim por diante. Sobre um montante de 100 reais, ao final de um ano o banco irá cobrar aproximadamente',
            ],
            [
                'theme' => $mathematicsTheme,
                'description' => '(Fuvest/2018) Maria quer comprar uma TV que está sendo vendida por R$ 1.500,00 à vista ou em 3 parcelas mensais sem juros de R$ 500,00. O dinheiro que Maria reservou para essa compra não é suficiente para pagar à vista, mas descobriu que o banco oferece uma aplicação financeira que rende 1% ao mês. Após fazer os cálculos, Maria concluiu que, se pagar a primeira parcela e, no mesmo dia, aplicar a quantia restante, conseguirá pagar as duas parcelas que faltam sem ter que colocar nem tirar um centavo sequer. Quanto Maria reservou para essa compra, em reais?',
            ],
            [
                'theme' => $mathematicsTheme,
                'description' => '(Fuvest/2018) Maria quer comprar uma TV que está sendo vendida por R$ 1.500,00 à vista ou em 3 parcelas mensais sem juros de R$ 500,00. O dinheiro que Maria reservou para essa compra não é suficiente para pagar à vista, mas descobriu que o banco oferece uma aplicação financeira que rende 1% ao mês. Após fazer os cálculos, Maria concluiu que, se pagar a primeira parcela e, no mesmo dia, aplicar a quantia restante, conseguirá pagar as duas parcelas que faltam sem ter que colocar nem tirar um centavo sequer. Quanto Maria reservou para essa compra, em reais?',
            ],
            [
                'theme' => $portugueseTheme,
                'description' => 'A palavra "latifúndio" está relacionada com:',
            ],
            [
                'theme' => $portugueseTheme,
                'description' => 'Uma loja que vende itens necessários à costura ou ao bordado (botão, linha, tecido, etc) é uma loja de...',
            ],
            [
                'theme' => $portugueseTheme,
                'description' => 'Notívago é aquele que...',
            ],
            [
                'theme' => $portugueseTheme,
                'description' => 'O coletivo de camelos é...',
            ],
            [
                'theme' => $portugueseTheme,
                'description' => 'Alentar é o mesmo que...',
            ],

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