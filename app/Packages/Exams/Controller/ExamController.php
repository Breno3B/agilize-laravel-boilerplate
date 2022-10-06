<?php

namespace App\Packages\Exams\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Exams\Facade\ExamFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct(
        protected ExamFacade $examFacade
    )
    {
    }

    public function index(): JsonResponse
    {
        $exams = $this->examFacade->index();
        return response()->json($exams->toArray(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $studentId = $request->get('student_id');
        $themeId = $request->get('theme_id');
        $quantityOfQuestions = $request->get('quantity_of_questions');
        $exam = $this->examFacade->store($studentId, $themeId, $quantityOfQuestions);
        return response()->json($exam->toArray(), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $status = $request->get('status');
        $questions = $request->get('questions');
        $exam = $this->examFacade->update($id, $status, $questions);
        return response()->json($exam->toArray(), 200);
    }

    public function show(string $id): JsonResponse
    {
        $exam = $this->examFacade->show($id);
        return response()->json($exam->toArray(), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->examFacade->destroy($id);
        return response()->json('exam removed successfully', 204);
    }
}