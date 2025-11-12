<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Stringable;

class BoundingBox implements Stringable
{
    public function __construct(
        public Point $bottomLeft,
        public Point $topRight,
    ) {
    }

    public function __toString(): string
    {
        return "{$this->bottomLeft}~{$this->topRight}";
    }
}
