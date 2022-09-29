<?php

namespace App\Packages\Exams\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Exams\Facade\AlternativeFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function __construct(
        protected AlternativeFacade $alternativeFacade
    )
    {
    }
    public function index(): JsonResponse
    {
        $alternatives = $this->alternativeFacade->index();
        return response()->json($alternatives->toArray(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $questionId = $request->get('question_id');
        $description = $request->get('description');
        $isCorrect = $request->get('is_correct');
        $alternative = $this->alternativeFacade->store($questionId, $description, $isCorrect);
        return response()->json($alternative->toArray(), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $questionId = $request->get('question_id');
        $description = $request->get('description');
        $isCorrect = $request->get('is_correct');
        $alternative = $this->alternativeFacade->update($id, $questionId, $description, $isCorrect);
        return response()->json($alternative->toArray(), 200);
    }

    public function show(string $id): JsonResponse
    {
        $alternative = $this->alternativeFacade->show($id);
        return response()->json($alternative->toArray(), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->alternativeFacade->destroy($id);
        return response()->json('alternative removed successfully', 204);
    }
}