<?php

namespace App\Packages\Exam\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="theme")
 */
class Question
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
     * @param  string  $name
     * @param  string  $description
     */
    public function __construct(string $name, string $description)
    {
        $this->id = Str::uuid()->toString();
        $this->description = $description;
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

}