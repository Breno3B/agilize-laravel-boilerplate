<?php

namespace App\Packages\Student\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Student\Facade\StudentFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
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

    public function update(Request $request, string $id): JsonResponse
    {
        $name = $request->get('name');
        $student = $this->studentFacade->update($id, $name);
        return response()->json($student->toArray(), 200);
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $student = $this->studentFacade->show($id);
        return response()->json($student->toArray(), 200);
    }

    public function destroy(Request $request, string $id): JsonResponse
    {
        $this->studentFacade->destroy($id);
        return response()->json('user removed successfully', 204);
    }
}