<?php

namespace App\Packages\Exams\Model;


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
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

//    studentId

//    themeId

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

    /**
     * @param  string  $status
     * @param  int  $quantityOfQuestions
     * @param  float  $totalScore
     * @param  DateTime  $startedAt
     * @param  DateTime  $finishedAt
     */
    public function __construct(
        string $status,
        int $quantityOfQuestions,
        float $totalScore,
        DateTime $startedAt,
        DateTime $finishedAt
    ) {
        $this->id = Str::uuid()->toString();
        $this->status = $status;
        $this->quantityOfQuestions = $quantityOfQuestions;
        $this->totalScore = $totalScore;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * @param  int  $quantityOfQuestions
     */
    public function setQuantityOfQuestions(int $quantityOfQuestions): void
    {
        $this->quantityOfQuestions = $quantityOfQuestions;
    }

    /**
     * @return float
     */
    public function getTotalScore(): float
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
     * @return DateTime
     */
    public function getStartedAt(): DateTime
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
     * @return DateTime
     */
    public function getFinishedAt(): DateTime
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
}