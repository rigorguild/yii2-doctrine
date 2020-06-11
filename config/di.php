<?php

declare(strict_types=1);

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use yii\di\Container;
use YiiDoctrineExample\Application\Command\EmitOrderHandler;
use YiiDoctrineExample\DomainModel\Orders;
use YiiDoctrineExample\Infrastructure\Persistence\DoctrineOrmOrders;

$doctrineOrmConfig = require __DIR__ . '/doctrine-orm' . (YII_ENV_DEV ? '_dev' : '') . '.php';

return [
    'singletons' => [
        // Doctrine ORM
        Cache::class => static fn(): Cache => YII_ENV ? new ArrayCache() : new RedisCache(),

        EntityManagerInterface::class => static function(Container $container) use ($doctrineOrmConfig): EntityManagerInterface {
            $isDevMode = YII_ENV_DEV;
            $proxyDir = __DIR__ . '/../var/cache/' . YII_ENV . '/doctrine/orm/Proxies';
            $config = Setup::createXMLMetadataConfiguration([__DIR__ . "/../src/Infrastructure/Persistence/doctrine-mappings"], $isDevMode, $proxyDir, $container->get(Cache::class));

            $conn = [
                'driver' => $doctrineOrmConfig['driver'],
                'url' => $doctrineOrmConfig['url'],
            ];

            return EntityManager::create($conn, $config);
        },

        // Symfony Serializer
        SerializerInterface::class => static fn(Container $container): SerializerInterface => new Serializer([new ObjectNormalizer()], [new JsonEncoder()]),

        // Infra
        Orders::class => static fn(Container $container): DoctrineOrmOrders => new DoctrineOrmOrders($container->get(EntityManagerInterface::class)),

        // Command Handlers
        EmitOrderHandler::class => static fn(Container $container): EmitOrderHandler => new EmitOrderHandler($container->get(Orders::class))
    ]
];
