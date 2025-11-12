<?php

namespace Altrntv\YandexStaticApi;

readonly class Image
{
    public function __construct(
        public string $binary,
        public string $mimeType,
        public int    $size,
    ) {
    }
}
