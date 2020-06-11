<?php

declare(strict_types=1);

namespace YiiDoctrineExample\DomainModel;

final class OrderId
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
