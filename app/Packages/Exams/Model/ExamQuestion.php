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

//    exam_id

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\Column(type="float")
     */
    protected float $questionValue;

    /**
     * @param  string  $description
     * @param  float   $questionValue
     */
    public function __construct(string $description, float $questionValue) {
        $this->id = Str::uuid()->toString();
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getQuestionValue(): float
    {
        return $this->questionValue;
    }

    /**
     * @param  float  $questionValue
     */
    public function setQuestionValue(float $questionValue): void
    {
        $this->questionValue = $questionValue;
    }
}