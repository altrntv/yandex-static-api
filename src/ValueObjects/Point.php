<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Stringable;

class Point implements Stringable
{
    public function __construct(
        public float $longitude,
        public float $latitude,
    ) {
    }

    public function __toString(): string
    {
        return "{$this->longitude},{$this->latitude}";
    }
}
