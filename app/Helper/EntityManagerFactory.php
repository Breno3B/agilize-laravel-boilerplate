<?php

namespace App\Helper;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

/**
 * Class EntityManagerFactory
 * @package App\Helper
 */
class EntityManagerFactory
{
    /**
     * @return EntityManager
     * @throws ORMException
     */
    public static function getEntityManager(): EntityManager
    {
        $rootDir = __DIR__ . '/../../../';

        $config = ORMSetup::createAnnotationMetadataConfiguration(
            [$rootDir . '/app'],
            true
        );
        $connection = [
            'driver' => 'pdo_pgsql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD')
        ];

        return EntityManager::create($connection, $config);
    }
}