<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\ExamQuestion;

class ExamQuestionRepository extends AbstractRepository
{
    public string $entityName = ExamQuestion::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(ExamQuestion $examQuestion): ExamQuestion
    {
        $this->getEntityManager()->persist($examQuestion);
        $this->getEntityManager()->flush();
        return $examQuestion;
    }
}