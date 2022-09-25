<?php

namespace App\Packages\Student\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Repository\StudentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentRepository $studentRepository,
        protected StudentFacade $studentFacade
    )
    {
    }

    public function index(): JsonResponse
    {
        $students = $this->studentFacade->index();
        return response()->json($students->toArray(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $name = $request->get('name');
        $student = $this->studentFacade->store($name);
        return response()->json($student->toArray(), 201);
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