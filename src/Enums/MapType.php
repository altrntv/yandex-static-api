<?php

namespace Altrntv\YandexStaticApi\Enums;

enum MapType: string
{
    case Map = 'map';
    case Driving = 'driving';
    case Transit = 'transit';
    case Admin = 'admin';
}
