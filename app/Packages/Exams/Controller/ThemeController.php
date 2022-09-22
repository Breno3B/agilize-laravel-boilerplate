<?php

namespace App\Packages\Exams\Controller;


use App\Http\Controllers\Controller;
use App\Packages\Exams\Model\Theme;
use App\Packages\Exams\Repository\ThemeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function __construct(
        protected ThemeRepository $themeRepository
    )
    {
    }

    public function index(): array
    {
        return $this->themeRepository->index();
    }

    public function store(Request $request): JsonResponse
    {
        $theme = new Theme(
            $request->get('name'),
            $request->get('description')
        );

        $this->themeRepository->store($theme);

        return response()->json($theme, 201);
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