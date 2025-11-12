<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Stringable;

class Size implements Stringable
{
    public function __construct(
        public int $width,
        public int $height,
    ) {
    }

    public function __toString(): string
    {
        return "{$this->width},{$this->height}";
    }
}
