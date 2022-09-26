<?php

namespace App\Packages\Student\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Student\Model\Student;

class StudentRepository extends AbstractRepository
{
    public string $entityName = Student::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(Student $student): Student
    {
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
        return $student;
    }

    public function destroy(Student $student): void
    {
        $this->getEntityManager()->remove($student);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?Student
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findOneByName(string $name): ?Student
    {
        return $this->findOneBy(['name' => $name]);
    }
}