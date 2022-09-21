<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\Theme;

class ThemeRepository extends AbstractRepository
{
    public string $entityName = Theme::class;

    public function findOneByName(string $name): ?Theme
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findOneByDescription(string $description): ?Theme
    {
        return $this->findOneBy(['description' => $description]);
    }
}