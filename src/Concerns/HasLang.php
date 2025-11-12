<?php

namespace Altrntv\YandexStaticApi\Concerns;

use Altrntv\YandexStaticApi\Enums\Language;

trait HasLang
{
    protected ?Language $language = null;

    public function language(Language $language): static
    {
        $this->language = $language;

        return $this;
    }
}
