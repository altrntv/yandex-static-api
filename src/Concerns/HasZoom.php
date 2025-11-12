<?php

namespace Altrntv\YandexStaticApi\Concerns;

trait HasZoom
{
    protected ?int $zoom = null;

    public function zoom(int $zoom): static
    {
        $this->zoom = $zoom;

        return $this;
    }
}
