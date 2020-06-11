<?php

declare(strict_types=1);

namespace YiiDoctrineExample\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use YiiDoctrineExample\DomainModel\Order;
use YiiDoctrineExample\DomainModel\OrderId;
use YiiDoctrineExample\DomainModel\Orders;

final class DoctrineOrmOrders implements Orders
{
    private EntityManagerInterface $entityManger;

    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManger = $entityManger;
    }

    public function add(Order $order): void
    {
        $this->entityManger->persist($order);
    }

    public function byId(OrderId $id): ?Order
    {
        return $this->entityManger->find(Order::class, $id->id());
    }
}
