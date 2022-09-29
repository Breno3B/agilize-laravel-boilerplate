<?php

namespace App\Packages\Exams\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam_question")
 */
class ExamQuestion
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Exam", inversedBy="questions")
     */
    protected Exam $exam;

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\Column(type="float")
     */
    protected float $questionValue;

    /**
     * @param  Exam    $exam
     * @param  string  $description
     * @param  float   $questionValue
     */
    public function __construct(Exam $exam, string $description, float $questionValue) {
        $this->id = Str::uuid()->toString();
        $this->exam = $exam;
        $this->description = $description;
        $this->questionValue = $questionValue;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getQuestionValue(): float
    {
        return $this->questionValue;
    }
}