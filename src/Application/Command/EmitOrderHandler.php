<?php

declare(strict_types=1);

namespace YiiDoctrineExample\Application\Command;

use YiiDoctrineExample\DomainModel\Order;
use YiiDoctrineExample\DomainModel\Orders;
use YiiDoctrineExample\DomainModel\Price;

final class EmitOrderHandler
{
    private Orders $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    public function __invoke(EmitOrder $command): void
    {
        $this->orders->add(
            Order::emit(
                new Price($command->price())
            )
        );
    }
}
