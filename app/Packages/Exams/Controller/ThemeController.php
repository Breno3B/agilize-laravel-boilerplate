<?php

namespace App\Packages\Exams\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Exams\Facade\ThemeFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function __construct(
        protected ThemeFacade $themeFacade
    )
    {
    }

    public function index(): JsonResponse
    {
        $themes = $this->themeFacade->index();
        return response()->json($themes->toArray(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $theme = $this->themeFacade->store($name, $description);
        return response()->json($theme->toArray(), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $theme = $this->themeFacade->update($id, $name, $description);
        return response()->json($theme->toArray(), 200);
    }

    public function show(string $id): JsonResponse
    {
        $theme = $this->themeFacade->show($id);
        return response()->json($theme->toArray(), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->themeFacade->destroy($id);
        return response()->json('theme removed successfully', 204);
    }
}