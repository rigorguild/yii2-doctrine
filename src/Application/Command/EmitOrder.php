<?php

declare(strict_types=1);

namespace YiiDoctrineExample\Application\Command;

final class EmitOrder
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function price(): float
    {
        return $this->price;
    }
}
