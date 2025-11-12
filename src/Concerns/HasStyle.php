<?php

namespace Altrntv\YandexStaticApi\Concerns;

trait HasStyle
{
    protected ?string $style = null;

    public function style(string $style): static
    {
        $this->style = $style;

        return $this;
    }
}
