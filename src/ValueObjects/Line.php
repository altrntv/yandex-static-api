<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Altrntv\YandexStaticApi\Contracts\Figure;

class Line implements Figure
{
    /**
     * @param float[] $coordinates
     * @param string|null $lineColor
     * @param int|null $lineWidth
     * @param string|null $borderColor
     * @param int|null $borderWidth
     */
    public function __construct(
        public array   $coordinates,
        public ?string $lineColor = null,
        public ?int    $lineWidth = null,
        public ?string $borderColor = null,
        public ?int    $borderWidth = null,
    ) {
    }

    public function __toString(): string
    {
        $value = '';

        if (is_null($this->lineColor)) {
            $value .= "c:{$this->lineColor},";
        }

        if (is_null($this->lineWidth)) {
            $value .= "w:{$this->lineWidth},";
        }

        if (is_null($this->borderColor)) {
            $value .= "bc:{$this->borderColor},";
        }

        if (is_null($this->borderWidth)) {
            $value .= "bw:{$this->borderWidth},";
        }

        $value .= implode(',', $this->coordinates);

        return trim($value, ',');
    }
}
