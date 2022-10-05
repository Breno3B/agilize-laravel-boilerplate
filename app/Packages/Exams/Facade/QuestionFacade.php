<?php

namespace App\Packages\Exams\Facade;


use App\Packages\Exams\Model\Question;
use App\Packages\Exams\Repository\QuestionRepository;
use App\Packages\Exams\Repository\ThemeRepository;
use Illuminate\Support\Collection;

class QuestionFacade
{
    public function __construct(
        protected QuestionRepository $questionRepository,
        protected ThemeRepository $themeRepository,
    )
    {
    }

    public function index(): Collection
    {
        $questions = $this->questionRepository->index();
        $questionCollection = collect();

        foreach ($questions as $question) {
            $questionCollection->add(
                [
                    'id'   => $question->getId(),
                    'theme' => $question->getTheme()->getName(),
                    'description' => $question->getDescription()
                ]
            );
        }

        return $questionCollection;
    }

    public function store(string $themeId, string $description): Collection
    {
        $theme = $this->themeRepository->findOneById($themeId);

        if (!$theme) {
            return collect([]);
        }

        $question = new Question($theme, $description);
        $question = $this->questionRepository->store($question);

        return collect([
            'id'   => $question->getId(),
            'theme' => $question->getTheme()->getName(),
            'description' => $question->getDescription(),
        ]);
    }

    public function update(string $id, string $themeId, string $description): Collection
    {
        $question = $this->questionRepository->findOneById($id);
        $theme = $this->themeRepository->findOneById($themeId);

        if (!$theme) {
            return collect([]);
        }

        $question->setTheme($theme);
        $question->setDescription($description);
        $question = $this->questionRepository->store($question);

        return collect([
            'id'   => $question->getId(),
            'theme' => $question->getTheme()->getName(),
            'description' => $question->getDescription(),
        ]);
    }

    public function show(string $id): Collection
    {
        $question = $this->questionRepository->findOneById($id);

        if (!$question) {
            return collect([]);
        }

        return collect([
            'id'   => $question->getId(),
            'theme' => $question->getTheme()->getName(),
            'description' => $question->getDescription(),
        ]);
    }

    public function destroy(string $id): void
    {
        $question = $this->questionRepository->findOneById($id);
        $this->questionRepository->destroy($question);
    }
}