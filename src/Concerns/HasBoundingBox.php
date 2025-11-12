<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\ValueObjects\BoundingBox;

trait HasBoundingBox
{
    protected ?BoundingBox $boundingBox = null;

    public function boundingBox(BoundingBox $boundingBox): static
    {
        $this->boundingBox = $boundingBox;

        return $this;
    }
}
