<?php

namespace App\Packages\Exams\Model;


use App\Packages\Student\Model\Student;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */
class Exam
{
    const EXAM_MAX_SCORE = 10;
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Packages\Student\Model\Student")
     */
    protected Student $student;

    /**
     * @ORM\ManyToOne(targetEntity="Theme")
     */
    protected Theme $theme;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected string $status;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $quantityOfQuestions;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected float|null $totalScore;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected Datetime|null $startedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected Datetime|null $finishedAt;

    /**
     * @ORM\OneToMany(targetEntity="ExamQuestion", mappedBy="exam", cascade={"all"}), orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"}))
     */
    protected Collection $questions;

    public function __construct(
        Student $student,
        Theme $theme,
        string $status,
        int $quantityOfQuestions,
        float|null $totalScore,
        DateTime|null $startedAt,
        DateTime|null $finishedAt
    ) {
        $this->id = Str::uuid()->toString();
        $this->student = $student;
        $this->theme = $theme;
        $this->status = $status;
        $this->quantityOfQuestions = $quantityOfQuestions;
        $this->totalScore = $totalScore;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
        $this->questions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param  string  $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getQuantityOfQuestions(): int
    {
        return $this->quantityOfQuestions;
    }

    /**
     * @return float|null
     */
    public function getTotalScore(): float|null
    {
        return $this->totalScore;
    }

    /**
     * @param  float  $totalScore
     */
    public function setTotalScore(float $totalScore): void
    {
        $this->totalScore = $totalScore;
    }

    /**
     * @return DateTime|null
     */
    public function getStartedAt(): DateTime|null
    {
        return $this->startedAt;
    }

    /**
     * @param  DateTime  $startedAt
     */
    public function setStartedAt(DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getFinishedAt(): DateTime|null
    {
        return $this->finishedAt;
    }

    /**
     * @param  DateTime  $finishedAt
     */
    public function setFinishedAt(DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }

    /**
     * @return Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }
}