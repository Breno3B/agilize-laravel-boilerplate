<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\ExamAlternative;

class ExamAlternativeRepository extends AbstractRepository
{
    public string $entityName = ExamAlternative::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(ExamAlternative $examAlternative): ExamAlternative
    {
        $this->getEntityManager()->persist($examAlternative);
        $this->getEntityManager()->flush();
        return $examAlternative;
    }

    public function update(?ExamAlternative $examAlternative): ExamAlternative
    {
        $this->getEntityManager()->persist($examAlternative);
        $this->getEntityManager()->flush();
        return $examAlternative;
    }

    public function destroy(ExamAlternative $examAlternative): void
    {
        $this->getEntityManager()->remove($examAlternative);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?ExamAlternative
    {
        return $this->findOneBy(['id' => $id]);
    }
}