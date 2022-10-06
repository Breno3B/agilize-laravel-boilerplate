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
use Carbon\Carbon;
use DateTime;
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

        /** @var Exam $exam */
        foreach ($exams as $exam) {
            $examsColelction->add(
                [
                    'id'                  => $exam->getId(),
                    'student'             => $exam->getStudent()->getName(),
                    'theme'               => $exam->getTheme()->getDescription(),
                    'status'              => $exam->getStatus(),
                    'quantityOfQuestions' => $exam->getQuantityOfQuestions(),
                    'totalScore'          => $exam->getTotalScore(),
                    'startedAt'           => $exam->getStartedAt(),
                    'finishedAt'          => $exam->getFinishedAt(),
                    'questions'           => $exam->getExamQuestions()->map(function (ExamQuestion $examQuestion) {
                            return [
                                'id'            => $examQuestion->getId(),
                                'question'      => $examQuestion->getDescription(),
                                'questionValue' => $examQuestion->getQuestionValue(),
                                'alternatives'  => $examQuestion->getExamAlternatives()->map(function (ExamAlternative $examAlternative) {
                                    return [
                                        'id'          => $examAlternative->getId(),
                                        'alternative' => $examAlternative->getDescription(),
                                    ];
                                })->toArray(),
                            ];
                    })->toArray(),
                ]
            );
        }

        return $examsColelction;
    }

    public function store(
        string $studentId,
        string $themeId,
        string $quantityOfQuestions,
        string $status = "Aberta",
        float|null $totalScore = null,
        DateTime|null $finishedAt = null
    ): Collection
    {
        $student = $this->studentRepository->findOneById($studentId);
        $theme = $this->themeRepository->findOneById($themeId);
        $questionValue = Exam::EXAM_MAX_SCORE / $quantityOfQuestions;

        if (!$student || !$theme) {
            return collect([]);
        }

        $exam = new Exam(
            $student,
            $theme,
            $status,
            $quantityOfQuestions,
            $totalScore,
            Carbon::now(),
            $finishedAt
        );
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
                    false
                );
                $this->examAlternativeRepository->store($examAlternative);
            }
        }

        return collect([
            'id'                  => $exam->getId(),
            'student'             => $exam->getStudent()->getName(),
            'theme'               => $exam->getTheme()->getDescription(),
            'status'              => $exam->getStatus(),
            'quantityOfQuestions' => $exam->getQuantityOfQuestions(),
            'totalScore'          => $exam->getTotalScore(),
            'startedAt'           => $exam->getStartedAt(),
            'finishedAt'          => $exam->getFinishedAt(),
        ]);
    }

    public function show(string $id): Collection
    {
        $exam = $this->examRepository->findOneById($id);

        if (!$exam) {
            return collect([]);
        }

        return $this->getCompleteExamCollect($exam);
    }

    public function update(string $id, string $status, $questions)
    {
        $exam = $this->examRepository->findOneById($id);

        if (!$exam) {
            return false;
        }

        $exam->setStatus($status);
        $exam->setFinishedAt(Carbon::now());

        $this->examRepository->update($exam);

        foreach ($questions as $question) {
            foreach ($question['alternatives'] as $alternative) {
                $examAlternative = $this->examAlternativeRepository->findOneById($alternative['id']);
                $examAlternative->setIsChosen($alternative['isChosen']);
                $this->examAlternativeRepository->update($examAlternative);
            }
        }

        return $this->getCompleteExamCollect($exam);
    }

    public function destroy(string $id): bool
    {
        $exam = $this->examRepository->findOneById($id);

        if (!$exam) {
            return false;
        }

        $this->examRepository->destroy($exam);

        return true;
    }

    /**
     * @param  Exam  $exam
     *
     * @return Collection
     */
    public function getCompleteExamCollect(Exam $exam): Collection
    {
        return collect([
            'id'                  => $exam->getId(),
            'student'             => $exam->getStudent()->getName(),
            'theme'               => $exam->getTheme()->getDescription(),
            'status'              => $exam->getStatus(),
            'quantityOfQuestions' => $exam->getQuantityOfQuestions(),
            'totalScore'          => $exam->getTotalScore(),
            'startedAt'           => $exam->getStartedAt(),
            'finishedAt'          => $exam->getFinishedAt(),
            'questions'           => $exam->getExamQuestions()->map(function (ExamQuestion $examQuestion) {
                return [
                    'id'            => $examQuestion->getId(),
                    'question'      => $examQuestion->getDescription(),
                    'questionValue' => $examQuestion->getQuestionValue(),
                    'alternatives'  => $examQuestion->getExamAlternatives()->map(function (ExamAlternative $examAlternative) {
                        return [
                            'id'          => $examAlternative->getId(),
                            'alternative' => $examAlternative->getDescription(),
                            'isCorrect'   => $examAlternative->isCorrect(),
                            'isChosen'    => $examAlternative->isChosen( ),
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ]);
    }
}