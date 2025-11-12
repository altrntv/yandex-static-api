<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\ValueObjects\Size;

trait HasSize
{
    protected ?Size $size = null;

    public function size(Size $size): static
    {
        $this->size = $size;

        return $this;
    }
}
