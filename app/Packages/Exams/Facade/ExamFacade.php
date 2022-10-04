<?php

namespace App\Packages\Exams\Facade;


use App\Packages\Exams\Model\Exam;
use App\Packages\Exams\Model\ExamAlternative;
use App\Packages\Exams\Model\ExamQuestion;
use App\Packages\Exams\Repository\AlternativeRepository;
use App\Packages\Exams\Repository\ExamAlternativeRepository;
use App\Packages\Exams\Repository\ExamQuestionRepository;
use App\Packages\Exams\Repository\ExamRepository;
use App\Packages\Exams\Repository\QuestionRepository;
use App\Packages\Exams\Repository\ThemeRepository;
use App\Packages\Student\Repository\StudentRepository;
use Illuminate\Support\Collection;

class ExamFacade
{
    public function __construct(
        protected StudentRepository $studentRepository,
        protected ThemeRepository $themeRepository,
        protected QuestionRepository $questionRepository,
        protected AlternativeRepository $alternativeRepository,
        protected ExamRepository $examRepository,
        protected ExamQuestionRepository $examQuestionRepository,
        protected ExamAlternativeRepository $examAlternativeRepository,
    )
    {
    }

    public function index(): Collection
    {
        $exams = $this->examRepository->index();
        $examsColelction = collect();

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
        $questionValue = Exam::EXAM_MAX_SCORE / $quantityOfQuestions;

        if (!$student || !$theme) {
            return collect([]);
        }

        $exam = new Exam($student, $theme, $status, $quantityOfQuestions, $totalScore, $startedAt, $finishedAt);
        $exam = $this->examRepository->store($exam);

        // ExamQuestions
        $allQuestionsByTheme = $this->questionRepository->findAllByThemeId($themeId);
        $examQuestionsIndexes = array_rand($allQuestionsByTheme, $quantityOfQuestions);

        for ($i = 0; $i < $quantityOfQuestions; $i++) {
            $question = $allQuestionsByTheme[$examQuestionsIndexes[$i]];
            $examQuestion = new ExamQuestion(
                $exam,
                $question->getDescription(),
                $questionValue
            );
            $this->examQuestionRepository->store($examQuestion);

            // Alternatives
            $alternatives = $this->alternativeRepository->findAllByQuestionId($question->getId());
            /** @var ExamAlternative $alternative */
            foreach ($alternatives as $alternative) {
                $examAlternative = new ExamAlternative(
                    $examQuestion,
                    $alternative->getDescription(),
                    $alternative->isCorrect(),
                    $alternative->isChosen()
                );
                $this->examAlternativeRepository->store($examAlternative);
            }
        }

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