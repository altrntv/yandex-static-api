<?php

namespace Altrntv\YandexStaticApi\Concerns;

trait HasSpan
{
    protected ?string $span = null;

    public function span(float $span): static
    {
        $this->span = "{$span},{$span}";

        return $this;
    }
}
