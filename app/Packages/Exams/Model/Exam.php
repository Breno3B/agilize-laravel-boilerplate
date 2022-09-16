<?php

namespace App\Packages\Exams\Model;


use App\Packages\Student\Model\Student;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */
class Exam
{
    //    #################### ATTRIBUTES ####################

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
    protected float $totalScore;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected Datetime $startedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected Datetime $finishedAt;

    //    #################### CONSTRUCTOR ####################

    /**
     * @param  Student   $student
     * @param  Theme     $theme
     * @param  string    $status
     * @param  int       $quantityOfQuestions
     * @param  float     $totalScore
     * @param  DateTime  $startedAt
     * @param  DateTime  $finishedAt
     */
    public function __construct(
        Student $student,
        Theme $theme,
        string $status,
        int $quantityOfQuestions,
        float $totalScore,
        DateTime $startedAt,
        DateTime $finishedAt
    ) {
        $this->id = Str::uuid()->toString();
        $this->student = $student;
        $this->theme = $theme;
        $this->status = $status;
        $this->quantityOfQuestions = $quantityOfQuestions;
        $this->totalScore = $totalScore;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
    }

    //    #################### GETTERS ####################

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
     * @return int
     */
    public function getQuantityOfQuestions(): int
    {
        return $this->quantityOfQuestions;
    }

    /**
     * @return float
     */
    public function getTotalScore(): float
    {
        return $this->totalScore;
    }

    /**
     * @return DateTime
     */
    public function getStartedAt(): DateTime
    {
        return $this->startedAt;
    }

    /**
     * @return DateTime
     */
    public function getFinishedAt(): DateTime
    {
        return $this->finishedAt;
    }

//    #################### SETTERS ####################

    /**
     * @param  string  $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param  float  $totalScore
     */
    public function setTotalScore(float $totalScore): void
    {
        $this->totalScore = $totalScore;
    }

    /**
     * @param  DateTime  $startedAt
     */
    public function setStartedAt(DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @param  DateTime  $finishedAt
     */
    public function setFinishedAt(DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }
}