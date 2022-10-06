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

    public function findOneByStudentId(string $studentId): ?Exam
    {
        return $this->findOneBy(['studentId' => $studentId]);
    }

    public function findOneByThemeId(string $themeId): ?Exam
    {
        return $this->findOneBy(['themeId' => $themeId]);
    }

    public function findOneByStatus(string $status): ?Exam
    {
        return $this->findOneBy(['status' => $status]);
    }

    public function findOneByQuantityOfQuestions(string $quantityOfQuestions): ?Exam
    {
        return $this->findOneBy(['quantityOfQuestions' => $quantityOfQuestions]);
    }

    public function findOneByTotalScore(string $totalScore): ?Exam
    {
        return $this->findOneBy(['totalScore' => $totalScore]);
    }

    public function findOneByStartedAt(string $startedAt): ?Exam
    {
        return $this->findOneBy(['startedAt' => $startedAt]);
    }

    public function findOneByFinishedAt(string $finishedAt): ?Exam
    {
        return $this->findOneBy(['finishedAt' => $finishedAt]);
    }
}