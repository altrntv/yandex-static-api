<?php

use Altrntv\YandexStaticApi\StaticApi;
use Altrntv\YandexStaticApi\ValueObjects\Point;
use Altrntv\YandexStaticApi\ValueObjects\Size;

beforeEach(function () {
    $this->point = new Point(14.428666, 50.083472);
});

it('invalid scale argument', function () {
    StaticApi::make($this->point)
        ->scale(10)
        ->url();
})->throws(InvalidArgumentException::class, 'Invalid scale: 10. The scale must be between 1.0 and 4.0.');

it('invalid size width argument', function () {
    new Size(1000, 400);
})->throws(InvalidArgumentException::class, 'Invalid map width: 1000. The width must be between 1 and 650 pixels.');

it('invalid size height argument', function () {
    new Size(600, 500);
})->throws(InvalidArgumentException::class, 'Invalid map height: 500. The height must be between 1 and 450 pixels.');

it('invalid zoom argument', function () {
    StaticApi::make($this->point)
        ->zoom(30)
        ->url();
})->throws(InvalidArgumentException::class, 'Invalid zoom: 30. The zoom must be between 0 and 21.');

it('invalid point longitude argument', function () {
    new Point(190, 80);
})->throws(InvalidArgumentException::class, 'Invalid longitude value: 190.000000. Longitude must be between -180 and +180 degrees.');

it('invalid size latitude argument', function () {
    new Point(54, 100);
})->throws(InvalidArgumentException::class, 'Invalid latitude value: 100.000000. Latitude must be between -90 and +90 degrees.');
