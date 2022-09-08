<?php

namespace App\Packages\Exams\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected string $description;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected bool $correct;

    /**
     * @param  string  $name
     * @param  string  $description
     */
    public function __construct(string $name, string $description, bool $correct)
    {
        $this->id = Str::uuid()->toString();
        $this->description = $description;
        $this->correct = $correct;
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
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->correct;
    }

    /**
     * @param  bool  $correct
     */
    public function setCorrect(bool $correct): void
    {
        $this->correct = $correct;
    }
}