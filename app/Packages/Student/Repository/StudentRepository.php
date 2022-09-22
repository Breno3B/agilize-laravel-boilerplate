<?php

namespace App\Packages\Student\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Student\Model\Student;

class StudentRepository extends AbstractRepository
{
    public string $entityName = Student::class;

    public function Index(): array
    {
        return $this->findAll();
    }

    public function store(Student $student): Student
    {
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
        return $student;
    }

    public function findOneByName(string $name): ?Student
    {
        return $this->findOneBy(['name' => $name]);
    }
}