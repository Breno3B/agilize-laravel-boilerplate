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
        $status = $request->get('status');
        $quantityOfQuestions = $request->get('quantity_of_questions');
        $exam = $this->examFacade->store($studentId, $themeId, $status, $quantityOfQuestions);
        return response()->json($exam->toArray(), 201);
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