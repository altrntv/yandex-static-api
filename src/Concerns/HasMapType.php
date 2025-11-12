<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\Enums\MapType;

trait HasMapType
{
    protected ?MapType $mapType = null;

    public function mapType(MapType $mapType): static
    {
        $this->mapType = $mapType;

        return $this;
    }
}
