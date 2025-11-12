<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\Contracts\Figure;

trait HasFigures
{
    /** @var Figure[] */
    protected array $figures = [];

    /**
     * @param Figure[] $figures
     */
    public function figures(array $figures): static
    {
        $this->figures = $figures;

        return $this;
    }
}
