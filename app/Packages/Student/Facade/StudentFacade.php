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
        $students = $this->studentRepository->index();
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

    public function update(string $id,string $name): Collection
    {
        $student = $this->studentRepository->findOneById($id);

        $student->setName($name);
        $student = $this->studentRepository->store($student);

        return collect([
            'id'   => $student->getId(),
            'name' => $student->getName()
        ]);
    }

    public function show(string $id): Collection
    {
        $student = $this->studentRepository->findOneById($id);

        return collect([
            'id'   => $student->getId(),
            'name' => $student->getName()
        ]);
    }

    public function destroy(string $id): void
    {
        $student = $this->studentRepository->findOneById($id);
        $this->studentRepository->destroy($student);
    }
}