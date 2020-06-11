<?php

declare(strict_types=1);

namespace YiiDoctrineExample\DomainModel;

interface Orders
{
    public function add(Order $order): void;
    public function byId(OrderId $id): ?Order;
}
