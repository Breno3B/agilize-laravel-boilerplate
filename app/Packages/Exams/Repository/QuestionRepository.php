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

    public function findOneByName(string $name): ?Question
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findOneByDescription(string $description): ?Question
    {
        return $this->findOneBy(['description' => $description]);
    }

    public function findOneByThemeId(string $themeId): ?Question
    {
        return $this->findOneBy(['themeId' => $themeId]);
    }
}