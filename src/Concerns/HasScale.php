<?php

namespace Altrntv\YandexStaticApi\Concerns;

trait HasScale
{
    protected ?float $scale = null;

    public function scale(float $scale): static
    {
        $this->scale = $scale;

        return $this;
    }
}
