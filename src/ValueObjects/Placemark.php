<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use Altrntv\YandexStaticApi\Enums\PlacemarkColor;
use Altrntv\YandexStaticApi\Enums\PlacemarkSize;
use Altrntv\YandexStaticApi\Enums\PlacemarkStyle;
use Stringable;

class Placemark implements Stringable
{
    public function __construct(
        public Point           $point,
        public ?PlacemarkStyle $style = null,
        public ?PlacemarkColor $color = null,
        public ?PlacemarkSize  $size = null,
        public ?int            $content = null,
    ) {
        if (is_null($this->style)) {
            return;
        }

        $this->color = $this->style->validateColor($this->color);

        $this->size = $this->style->validateSize($this->size);
    }

    public function __toString(): string
    {
        $value = "{$this->point},"
            . $this->style?->value
            . $this->color?->value
            . $this->size?->value
            . $this->content;

        return trim($value, ',');
    }
}
