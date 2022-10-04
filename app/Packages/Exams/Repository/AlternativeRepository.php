<?php

namespace App\Packages\Exams\Repository;


use App\Packages\Database\Repository\AbstractRepository;
use App\Packages\Exams\Model\Alternative;

class AlternativeRepository extends AbstractRepository
{
    public string $entityName = Alternative::class;

    public function index(): array
    {
        return $this->findAll();
    }

    public function store(Alternative $alternative): Alternative
    {
        $this->getEntityManager()->persist($alternative);
        $this->getEntityManager()->flush();
        return $alternative;
    }

    public function destroy(Alternative $alternative): void
    {
        $this->getEntityManager()->remove($alternative);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): ?Alternative
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findAllByQuestionId(string $questionId): array
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT alternative FROM App\Packages\Exams\Model\Alternative alternative WHERE alternative.question = :questionId'
        );
        $query->setParameter('questionId', $questionId);
        return $query->getResult();
    }


}