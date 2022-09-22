<?php

namespace App\Packages\Student\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Student\Model\Student;
use App\Packages\Student\Repository\StudentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentRepository $studentRepository
    )
    {
    }

    public function index(): array
    {
        return $this->studentRepository->Index();
    }

    public function store(Request $request): JsonResponse
    {
        $student = new Student(
            $request->get('name')
        );

        $this->studentRepository->store($student);

        return response()->json($student->getName(), 201);
    }

    public function update()
    {
        return response()->json(['status' => true]);
    }

    public function show()
    {
        return response()->json(['status' => true]);
    }

    public function destroy()
    {
        return response()->json(['status' => true]);
    }
}