<?php

namespace App\Packages\Exams\Facade;


use App\Packages\Exams\Model\Alternative;
use App\Packages\Exams\Repository\AlternativeRepository;
use App\Packages\Exams\Repository\QuestionRepository;
use Illuminate\Support\Collection;

class AlternativeFacade
{
    public function __construct(
        protected AlternativeRepository $alternativeRepository,
        protected QuestionRepository $questionRepository,
    )
    {
    }

    public function index(): Collection
    {
        $alternatives = $this->alternativeRepository->index();
        $alternativeCollection = collect();

        foreach ($alternatives as $alternative) {
            $alternativeCollection->add(
                [
                    'id'   => $alternative->getId(),
                    'question' => $alternative->getQuestion()->getDescription(),
                    'description' => $alternative->getDescription(),
                    'isCorrect' => $alternative->isCorrect(),
                ]
            );
        }

        return $alternativeCollection;
    }

    public function store(string $questionId, string $description, string $isCorrect): Collection
    {
        $question = $this->questionRepository->findOneById($questionId);

        if (!$question) {
            return collect([]);
        }

        $alternative = new Alternative($question, $description, $isCorrect);
        $alternative = $this->alternativeRepository->store($alternative);

        return collect([
            'id'   => $alternative->getId(),
            'question' => $alternative->getQuestion()->getDescription(),
            'description' => $alternative->getDescription(),
            'isCorrect' => $alternative->isCorrect(),
        ]);
    }

    public function update(string $id, string $questionId, string $description, string $isCorrect): Collection
    {
        $alternative = $this->alternativeRepository->findOneById($id);

        $question = $this->questionRepository->findOneById($questionId);

        if (!$question) {
            return collect([]);
        }

        $alternative->setQuestion($question);
        $alternative->setDescription($description);
        $alternative->setIsCorrect($isCorrect);

        $alternative = $this->alternativeRepository->store($alternative);
        return collect([
            'id'   => $alternative->getId(),
            'question' => $alternative->getQuestion()->getDescription(),
            'description' => $alternative->getDescription(),
            'isCorrect' => $alternative->isCorrect(),
        ]);
    }

    public function show(string $id): Collection
    {
        $alternative = $this->alternativeRepository->findOneById($id);

        if (!$alternative) {
            return collect([]);
        }

        return collect([
            'id'   => $alternative->getId(),
            'question' => $alternative->getQuestion()->getDescription(),
            'description' => $alternative->getDescription(),
            'isCorrect' => $alternative->isCorrect(),
        ]);
    }

    public function destroy(string $id): void
    {
        $alternative = $this->alternativeRepository->findOneById($id);
        $this->alternativeRepository->destroy($alternative);
    }
}