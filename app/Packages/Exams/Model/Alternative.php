<?php

namespace App\Packages\Exams\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="alternative")
 */
class Alternative
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

//    question_id

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $isCorrect;

    /**
     * @param  string  $description
     * @param  bool    $isCorrect
     */
    public function __construct(string $description, bool $isCorrect) {
        $this->id = Str::uuid()->toString();
        $this->description = $description;
        $this->isCorrect = $isCorrect;
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
        return $this->isCorrect;
    }

    /**
     * @param  bool  $isCorrect
     */
    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }
}