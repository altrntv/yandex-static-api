<?php

use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiException;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiForbiddenException;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiTooManyRequestsException;
use Altrntv\YandexStaticApi\Image;
use Altrntv\YandexStaticApi\StaticApi;
use Altrntv\YandexStaticApi\ValueObjects\Point;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

beforeEach(function () {
    $this->point = new Point(32.81, 39.88);
});

it('handles success request', function () {
    Http::fake([
        'https://static-maps.yandex.ru/*' => Http::response(
            body: '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',
            status: SymfonyResponse::HTTP_OK,
            headers: [
                'Content-Type' => 'image/png',
                'Content-Length' => 1618,
            ],
        ),
    ]);

    $image = StaticApi::make($this->point)->fetch();

    expect($image)
        ->toBeInstanceOf(Image::class)
        ->and($image->size)->toBe(1618)
        ->and($image->mimeType)->toBe('image/png');
});

it('handles bad request', function () {
    Http::fake([
        'https://static-maps.yandex.ru/*' => Http::response(status: SymfonyResponse::HTTP_BAD_REQUEST),
    ]);

    StaticApi::make($this->point)->fetch();

})->throws(
    YandexStaticApiException::class,
    'Yandex Static API Error',
    SymfonyResponse::HTTP_BAD_REQUEST,
);

it('handles too many requests', function () {
    Http::fake([
        'https://static-maps.yandex.ru/*' => Http::response(status: SymfonyResponse::HTTP_TOO_MANY_REQUESTS),
    ]);

    StaticApi::make($this->point)->fetch();

})->throws(
    YandexStaticApiTooManyRequestsException::class,
    'Too Many Requests',
    SymfonyResponse::HTTP_TOO_MANY_REQUESTS,
);

it('handles forbidden request', function () {
    Http::fake([
        'https://static-maps.yandex.ru/*' => Http::response(status: SymfonyResponse::HTTP_FORBIDDEN),
    ]);

    StaticApi::make($this->point)->fetch();

})->throws(
    YandexStaticApiForbiddenException::class,
    'Invalid api key',
    SymfonyResponse::HTTP_FORBIDDEN,
);
