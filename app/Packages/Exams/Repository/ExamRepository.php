<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\Exam;

class ExamRepository extends AbstractRepository
{
    public string $entityName = Exam::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(Exam $exam): Exam
    {
        $this->getEntityManager()->persist($exam);
        $this->getEntityManager()->flush();
        return $exam;
    }

    public function update(Exam $exam): Exam
    {
        $this->getEntityManager()->persist($exam);
        $this->getEntityManager()->flush();
        return $exam;
    }

    public function destroy(Exam $exam): void
    {
        $this->getEntityManager()->remove($exam);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?Exam
    {
        return $this->findOneBy(['id' => $id]);
    }
}