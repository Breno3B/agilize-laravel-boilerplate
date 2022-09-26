<?php

namespace App\Packages\Exams\Facade;


use App\Packages\Exams\Model\Theme;
use App\Packages\Exams\Repository\ThemeRepository;
use Illuminate\Support\Collection;

class ThemeFacade
{
    public function __construct(
        protected ThemeRepository $themeRepository,
    )
    {
    }

    public function index(): Collection
    {
        $themes = $this->themeRepository->index();
        $themeCollection = collect();

        foreach ($themes as $theme) {
            $themeCollection->add(
                [
                    'id'   => $theme->getId(),
                    'name' => $theme->getName(),
                    'description' => $theme->getDescription()
                ]
            );
        };

        return $themeCollection;
    }

    public function store(string $name, string $description): Collection
    {
        $theme = $this->themeRepository->findOneByName($name);

        if ($theme) {
            return collect([
                'id'   => $theme->getId(),
                'name' => $theme->getName(),
                'description' => $theme->getDescription()
            ]);
        }

        $theme = new Theme($name, $description);
        $theme = $this->themeRepository->store($theme);

        return collect([
            'id'   => $theme->getId(),
            'name' => $theme->getName(),
            'description' => $theme->getDescription()
        ]);
    }

    public function update(string $id, string $name, string $description): Collection
    {
        $theme = $this->themeRepository->findOneById($id);

        $theme->setName($name);
        $theme->setDescription($description);
        $theme = $this->themeRepository->store($theme);

        return collect([
            'id'   => $theme->getId(),
            'name' => $theme->getName(),
            'description' => $theme->getDescription()
        ]);
    }

    public function show(string $id): Collection
    {
        $theme = $this->themeRepository->findOneById($id);

        return collect([
            'id'   => $theme->getId(),
            'name' => $theme->getName(),
            'description' => $theme->getDescription()
        ]);
    }

    public function destroy(string $id): void
    {
        $theme = $this->themeRepository->findOneById($id);
        $this->themeRepository->destroy($theme);
    }
}