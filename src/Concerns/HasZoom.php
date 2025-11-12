<?php

namespace Altrntv\YandexStaticApi\Concerns;

use InvalidArgumentException;

trait HasZoom
{
    protected ?int $zoom = null;

    /**
     * @param int $zoom Map zoom level (0-21)
     *
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function zoom(int $zoom): static
    {
        if ($zoom < 0 || $zoom > 21) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid zoom: %d. The zoom must be between 0 and 21.',
                    $zoom,
                )
            );
        }

        $this->zoom = $zoom;

        return $this;
    }
}
