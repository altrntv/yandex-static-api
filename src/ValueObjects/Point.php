<?php

namespace Altrntv\YandexStaticApi\ValueObjects;

use InvalidArgumentException;
use Stringable;

class Point implements Stringable
{
    protected float $longitude;

    protected float $latitude;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(float $longitude, float $latitude)
    {
        if (!($longitude >= -180.0 && $longitude <= 180.0)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid longitude value: %.6f. Longitude must be between -180 and +180 degrees.',
                    $longitude,
                )
            );
        }

        if (!($latitude >= -90.0 && $latitude <= 90.0)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid latitude value: %.6f. Latitude must be between -90 and +90 degrees.',
                    $latitude,
                )
            );
        }

        $this->longitude = $longitude;

        $this->latitude = $latitude;
    }

    public function __toString(): string
    {
        return "{$this->longitude},{$this->latitude}";
    }
}
