<?php

namespace App\Packages\Exams\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Exams\Facade\QuestionFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(
        protected QuestionFacade $questionFacade
    )
    {
    }

    public function index(): JsonResponse
    {
        $questions = $this->questionFacade->index();
        return response()->json($questions->toArray(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $themeId = $request->get('theme_id');
        $description = $request->get('description');
        $question = $this->questionFacade->store($themeId, $description);
        return response()->json($question->toArray(), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $themeId = $request->get('theme_id');
        $description = $request->get('description');
        $question = $this->questionFacade->update($id, $themeId, $description);
        return response()->json($question->toArray(), 200);
    }

    public function show(string $id): JsonResponse
    {
        $question = $this->questionFacade->show($id);
        return response()->json($question->toArray(), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->questionFacade->destroy($id);
        return response()->json('question removed successfully', 204);
    }
}