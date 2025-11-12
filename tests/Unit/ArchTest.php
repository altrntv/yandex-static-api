<?php

arch()
    ->expect('Altrntv\\YandexStaticApi')
    ->not->toUse(['die', 'dd', 'dump']);
