<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\Enums\Theme;

trait HasTheme
{
    protected ?Theme $theme = null;

    public function theme(Theme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }
}
