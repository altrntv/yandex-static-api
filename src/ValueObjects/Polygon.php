<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Altrntv\YandexStaticApi\Contracts\Figure;

class Polygon implements Figure
{
    /**
     * @param float[] $coordinates
     */
    public function __construct(
        public array   $coordinates,
        public ?string $lineColor = null,
        public ?string $fillColor = null,
        public ?int    $lineWidth = null,
    ) {
    }

    public function __toString(): string
    {
        $value = '';

        if (!is_null($this->lineColor)) {
            $value .= "c:{$this->lineColor},";
        }

        if (!is_null($this->fillColor)) {
            $value .= "f:{$this->fillColor},";
        }

        if (!is_null($this->lineWidth)) {
            $value .= "w:{$this->lineWidth},";
        }

        $value .= implode(',', $this->coordinates);

        return trim($value, ',');
    }
}
