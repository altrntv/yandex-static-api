<?php

use Altrntv\YandexStaticApi\Enums\Language;
use Altrntv\YandexStaticApi\Enums\MapType;
use Altrntv\YandexStaticApi\Enums\PlacemarkColor;
use Altrntv\YandexStaticApi\Enums\PlacemarkSize;
use Altrntv\YandexStaticApi\Enums\PlacemarkStyle;
use Altrntv\YandexStaticApi\Enums\Theme;
use Altrntv\YandexStaticApi\StaticApi;
use Altrntv\YandexStaticApi\ValueObjects\BoundingBox;
use Altrntv\YandexStaticApi\ValueObjects\Line;
use Altrntv\YandexStaticApi\ValueObjects\Placemark;
use Altrntv\YandexStaticApi\ValueObjects\Point;
use Altrntv\YandexStaticApi\ValueObjects\Polygon;
use Altrntv\YandexStaticApi\ValueObjects\Size;
use Illuminate\Support\Facades\Config;

beforeEach(function () {
    $this->point = new Point(14.428666, 50.083472);
});

it('accepts point and creates an URL', function () {
    $url = StaticApi::make($this->point)->url();

    expect($url)
        ->toStartWith('https://static-maps.yandex.ru')
        ->toContain('apikey=' . Config::string('yandex-static-api.api_key'))
        ->toContain('ll=14.428666%2C50.083472');
});

it('accepts bounding box and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->boundingBox(new BoundingBox(
            new Point(14.414642, 50.086028),
            new Point(14.462342, 50.067713),
        ))
        ->url();

    expect($url)
        ->toContain('bbox=14.414642%2C50.086028~14.462342%2C50.067713');
});

it('accepts figure line and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->figures([
            new Line(
                [
                    27.135483, 38.422478, 27.137685,
                    38.422469, 27.137736, 38.422564,
                    27.137789, 38.424045, 27.138519,
                    38.423975, 27.141899, 38.423802,
                    27.142215, 38.423756, 27.142333,
                    38.423697, 27.142376, 38.423549,
                    27.142596, 38.423368, 27.142971,
                    38.423347, 27.143285, 38.423625,
                    27.143245, 38.423912, 27.143015,
                    38.424102, 27.142795, 38.424128,
                    27.142795, 38.424128, 27.142387,
                    38.423918, 27.141909, 38.423918,
                    27.138275, 38.42422,
                ],
                'FFFFFFFF',
                7,
                '8822DDC0',
                5,
            ),
        ])
        ->decoderUrl();

    expect($url)
        ->toContain('pl=c:FFFFFFFF,w:7,bc:8822DDC0,bw:5,27.135483,38.422478,27.137685,38.422469,27.137736,38.422564,27.137789,38.424045,27.138519,38.423975,27.141899,38.423802,27.142215,38.423756,27.142333,38.423697,27.142376,38.423549,27.142596,38.423368,27.142971,38.423347,27.143285,38.423625,27.143245,38.423912,27.143015,38.424102,27.142795,38.424128,27.142795,38.424128,27.142387,38.423918,27.141909,38.423918,27.138275,38.42422');
});

it('accepts figure polygon and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->figures([
            new Polygon(
                [
                    29.088504, 41.052278, 29.097001, 41.042141,
                    29.08756, 41.044935, 29.088504, 41.052278,
                ],
                'FFFFFFFF',
                '2222DDC0',
                10
            ),
            new Polygon(
                [
                    29.100434, 41.048444, 29.086187, 41.04643,
                    29.089791, 41.042076, 29.100434, 41.048444,
                ],
                '8822DDC0',
                '00ff0055',
                2,
            ),
        ])
        ->decoderUrl();

    expect($url)
        ->toContain('pl=c:FFFFFFFF,f:2222DDC0,w:10,29.088504,41.052278,29.097001,41.042141,29.08756,41.044935,29.088504,41.052278~c:8822DDC0,f:00ff0055,w:2,29.100434,41.048444,29.086187,41.04643,29.089791,41.042076,29.100434,41.048444');
});

it('accepts lang and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->language(Language::EnglishRussia)
        ->url();

    expect($url)
        ->toContain('lang=en_RU');
});

it('accepts map type and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->mapType(MapType::Driving)
        ->url();

    expect($url)
        ->toContain('maptype=driving');
});

it('accepts placemark and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->placemarks([
            new Placemark(
                new Point(14.428666, 50.083472),
                PlacemarkStyle::Pm2,
                PlacemarkColor::Pink,
                PlacemarkSize::Medium,
                69,
            ),
            new Placemark(
                new Point(14.427666, 50.082472),
                PlacemarkStyle::YaRu,
                PlacemarkColor::Yellow,
                PlacemarkSize::Large,
                100,
            ),
        ])
        ->decoderUrl();

    expect($url)
        ->toContain('pt=14.428666,50.083472,pm2pnm69~14.427666,50.082472,ya_ru');
});

it('accepts scale and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->scale(2)
        ->url();

    expect($url)
        ->toContain('scale=2');
});

it('accepts size and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->size(new Size(600, 400))
        ->decoderUrl();

    expect($url)
        ->toContain('size=600,400');
});

it('accepts span and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->span(10)
        ->decoderUrl();

    expect($url)
        ->toContain('spn=10,10');
});

it('accepts style and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->style('tags.all:water|elements:geometry|stylers.opacity:0')
        ->decoderUrl();

    expect($url)
        ->toContain('style=tags.all:water|elements:geometry|stylers.opacity:0');
});

it('accepts theme and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->theme(Theme::Dark)
        ->url();

    expect($url)
        ->toContain('theme=dark');
});

it('accepts zoom and creates an URL', function () {
    $url = StaticApi::make($this->point)
        ->zoom(5)
        ->url();

    expect($url)
        ->toContain('z=5');
});
