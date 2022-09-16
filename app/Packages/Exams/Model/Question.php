<?php

namespace App\Packages\Exams\Model;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
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
     * @ORM\ManyToOne(targetEntity="Theme")
     */
    protected Theme $theme;

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @param  Theme   $theme
     * @param  string  $description
     */
    public function __construct(Theme $theme, string $description)
    {
        $this->id = Str::uuid()->toString();
        $this->theme = $theme;
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
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * @param  Theme  $theme
     */
    public function setTheme(Theme $theme): void
    {
        $this->theme = $theme;
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