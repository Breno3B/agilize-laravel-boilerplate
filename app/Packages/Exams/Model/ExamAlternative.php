<?php

namespace App\Packages\Exams\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam_alternative")
 */
class ExamAlternative
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="ExamQuestion")
     */
    protected ExamQuestion $examQuestion;

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $isCorrect;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $isChosen;

    /**
     * @param  ExamQuestion  $examQuestion
     * @param  string  $description
     * @param  bool  $isCorrect
     * @param  bool  $isChosen
     */
    public function __construct(ExamQuestion $examQuestion, string $description, bool $isCorrect, bool $isChosen) {
        $this->id = Str::uuid()->toString();
        $this->examQuestion = $examQuestion;
        $this->description = $description;
        $this->isCorrect = $isCorrect;
        $this->isChosen = $isChosen;
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
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    /**
     * @return bool
     */
    public function isChosen(): bool
    {
        return $this->isChosen;
    }

    /**
     * @param  bool  $isChosen
     */
    public function setIsChosen(bool $isChosen): void
    {
        $this->isChosen = $isChosen;
    }
}