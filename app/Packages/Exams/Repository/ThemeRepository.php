<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\Theme;

class ThemeRepository extends AbstractRepository
{
    public string $entityName = Theme::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(Theme $theme): Theme
    {
        $this->getEntityManager()->persist($theme);
        $this->getEntityManager()->flush();
        return $theme;
    }

    public function destroy(Theme $theme): void
    {
        $this->getEntityManager()->remove($theme);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?Theme
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findOneByName(string $name): ?Theme
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findOneByDescription(string $description): ?Theme
    {
        return $this->findOneBy(['description' => $description]);
    }
}