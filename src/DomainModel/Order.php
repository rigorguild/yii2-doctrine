<?php

declare(strict_types=1);

namespace YiiDoctrineExample\DomainModel;

class Order
{
    private OrderId $id;
    private Price $price;

    private function __construct(Price $price)
    {
        $this->price = $price;
    }

    public static function emit(Price $price): self
    {
        return new self($price);
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
