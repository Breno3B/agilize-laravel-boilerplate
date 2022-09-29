<?php

namespace App\Packages\Exams\Facade;


use App\Packages\Exams\Model\Exam;
use App\Packages\Exams\Repository\AlternativeRepository;
use App\Packages\Exams\Repository\ExamRepository;
use App\Packages\Exams\Repository\QuestionRepository;
use App\Packages\Exams\Repository\ThemeRepository;
use App\Packages\Student\Repository\StudentRepository;
use Illuminate\Support\Collection;

class ExamFacade
{
    public function __construct(
        protected ExamRepository $examRepository,
        protected AlternativeRepository $alternativeRepository,
        protected QuestionRepository $questionRepository,
        protected ThemeRepository $themeRepository,
        protected StudentRepository $studentRepository,
    )
    {
    }

    public function index(): Collection
    {
        $exams = $this->examRepository->index();
        $examsColelction = collect();
//        dd($exams);

        foreach ($exams as $exam) {
            $examsColelction->add(
                [
                    'id'   => $exam->getId(),
                    'student' => $exam->getStudent()->getName(),
                    'theme' => $exam->getTheme()->getDescription(),
                    'status' => $exam->getStatus(),
                    'quantityOfQuestions' => $exam->getQuantityOfQuestions(),
                    'totalScore' => $exam->getTotalScore(),
                    'startedAt' => $exam->getStartedAt(),
                    'finishedAt' => $exam->getFinishedAt(),
                    'questions' => $exam->getQuestions()->toArray(),
                ]
            );
        }
        return $examsColelction;
    }

    public function store(
        string $studentId,
        string $themeId,
        string $status,
        string $quantityOfQuestions,
        float|null $totalScore = null,
        string|null $startedAt = null,
        string|null $finishedAt = null
    ): Collection
    {
        $student = $this->studentRepository->findOneById($studentId);
        $theme = $this->themeRepository->findOneById($themeId);

        if (!$student || !$theme) {
            return collect([]);
        }

        $exam = new Exam($student, $theme, $status, $quantityOfQuestions, $totalScore, $startedAt, $finishedAt);
        $exam = $this->examRepository->store($exam);

        // Questões


        //Alternativas

        return collect([
            'id'   => $exam->getId(),
            'student' => $exam->getStudent()->getName(),
            'theme' => $exam->getTheme()->getDescription(),
            'status' => $exam->getStatus(),
            'quantityOfQuestions' => $exam->getQuantityOfQuestions(),
            'totalScore' => $exam->getTotalScore(),
            'startedAt' => $exam->getStartedAt(),
            'finishedAt' => $exam->getFinishedAt(),
        ]);
    }
}