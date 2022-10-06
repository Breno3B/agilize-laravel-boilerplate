<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\Question;

class QuestionRepository extends AbstractRepository
{
    public string $entityName = Question::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(Question $question): Question
    {
        $this->getEntityManager()->persist($question);
        $this->getEntityManager()->flush();
        return $question;
    }

    public function destroy(Question $question): void
    {
        $this->getEntityManager()->remove($question);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?Question
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findAllByThemeId(string $themeId): array
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT question FROM App\Packages\Exams\Model\Question question WHERE question.theme = :themeId'
        );
        $query->setParameter('themeId', $themeId);
        return $query->getResult();
    }
}