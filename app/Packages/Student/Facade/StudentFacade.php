<?php

namespace App\Packages\Student\Facade;


use App\Packages\Student\Model\Student;
use App\Packages\Student\Repository\StudentRepository;
use Illuminate\Support\Collection;

class StudentFacade
{
    public function __construct(
        protected StudentRepository $studentRepository,
    )
    {
    }

    public function index(): Collection
    {
        $students = $this->studentRepository->findAllStudents();
        $studentsCollection = collect();

        foreach ($students as $student) {
            $studentsCollection->add(
                [
                    'id'   => $student->getId(),
                    'name' => $student->getName()
                ]
            );
        };

        return $studentsCollection;
    }

    public function store(string $name): Collection
    {
        $student = $this->studentRepository->findOneByName($name);

        if ($student) {
            return collect([
                'id'   => $student->getId(),
                'name' => $student->getName()
            ]);
        }

        $student = new Student($name);
        $student = $this->studentRepository->store($student);

        return collect([
            'id'   => $student->getId(),
            'name' => $student->getName()
        ]);
    }
}