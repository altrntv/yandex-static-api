<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use InvalidArgumentException;
use Stringable;

class Size implements Stringable
{
    protected int $width;

    protected int $height;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(int $width, int $height)
    {
        if (!($width > 1 && $width <= 650)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid map width: %d. The width must be between 1 and 650 pixels.',
                    $width,
                )
            );
        }

        if (!($height > 1 && $height <= 450)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid map height: %d. The height must be between 1 and 450 pixels.',
                    $height,
                )
            );
        }

        $this->width = $width;

        $this->height = $height;
    }

    public function __toString(): string
    {
        return "{$this->width},{$this->height}";
    }
}
