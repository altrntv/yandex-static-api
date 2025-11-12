<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\ValueObjects\Placemark;

trait HasPlacemarks
{
    /** @var Placemark[] */
    protected array $placemarks = [];

    /**
     * @param Placemark[] $placemarks
     */
    public function placemarks(array $placemarks): static
    {
        $this->placemarks = $placemarks;

        return $this;
    }
}
