<?php

namespace Altrntv\YandexStaticApi\Concerns;

use InvalidArgumentException;

trait HasScale
{
    protected ?float $scale = null;

    /**
     * @param float $scale The scale factor (1.0–4.0).
     *
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function scale(float $scale): static
    {
        if ($scale < 1.0 || $scale > 4.0) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid scale: %d. The scale must be between 1.0 and 4.0.',
                    $scale,
                )
            );
        }

        $this->scale = $scale;

        return $this;
    }
}
