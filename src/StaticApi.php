<?php

namespace Altrntv\YandexStaticApi;

use Altrntv\YandexStaticApi\Concerns\HasBoundingBox;
use Altrntv\YandexStaticApi\Concerns\HasFigures;
use Altrntv\YandexStaticApi\Concerns\HasLang;
use Altrntv\YandexStaticApi\Concerns\HasMapType;
use Altrntv\YandexStaticApi\Concerns\HasPlacemarks;
use Altrntv\YandexStaticApi\Concerns\HasScale;
use Altrntv\YandexStaticApi\Concerns\HasSize;
use Altrntv\YandexStaticApi\Concerns\HasSpan;
use Altrntv\YandexStaticApi\Concerns\HasStyle;
use Altrntv\YandexStaticApi\Concerns\HasTheme;
use Altrntv\YandexStaticApi\Concerns\HasZoom;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiConnectionException;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiException;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiForbiddenException;
use Altrntv\YandexStaticApi\Exceptions\YandexStaticApiTooManyRequestsException;
use Altrntv\YandexStaticApi\ValueObjects\Point;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class StaticApi
{
    use HasBoundingBox;
    use HasFigures;
    use HasLang;
    use HasMapType;
    use HasPlacemarks;
    use HasScale;
    use HasSize;
    use HasSpan;
    use HasStyle;
    use HasTheme;
    use HasZoom;

    protected string $apiKey;

    protected PendingRequest $pendingRequest;

    protected Point $point;

    public function __construct(Point $point)
    {
        $this->apiKey = Config::string('yandex-static-api.api_key');

        $this->pendingRequest = Http::createPendingRequest()
            ->timeout(60)
            ->asJson()
            ->accept('image/png')
            ->baseUrl(Config::string('yandex-static-api.url'));

        $this->point = $point;
    }

    public static function make(Point $point): static
    {
        return new static($point);
    }

    /**
     * @throws YandexStaticApiException
     */
    public function sendRequest(): Image
    {
        try {
            $response = $this->pendingRequest
                ->get('v1', $this->toQueryParam());
        } catch (ConnectionException $exception) {
            throw new YandexStaticApiConnectionException($exception->getMessage(), $exception->getCode());
        }

        $this->checkResponse($response);

        return new Image(
            binary: $response->body(),
            mimeType: $response->header('Content-Type'),
            size: (int)$response->header('Content-Length'),
        );
    }

    /**
     * @throws YandexStaticApiException
     */
    private function checkResponse(Response $response): void
    {
        if ($response->forbidden()) {
            throw new YandexStaticApiForbiddenException('Invalid api key', SymfonyResponse::HTTP_FORBIDDEN);
        }

        if ($response->status() === SymfonyResponse::HTTP_TOO_MANY_REQUESTS) {
            throw new YandexStaticApiTooManyRequestsException('Too Many Requests', SymfonyResponse::HTTP_TOO_MANY_REQUESTS);
        }

        if ($response->failed()) {
            throw new YandexStaticApiException($this->errorMessage($response), SymfonyResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @return array<string, string>
     */
    private function toQueryParam(): array
    {
        return array_filter([
            'apikey' => $this->apiKey,
            'll' => (string)$this->point,
            'spn' => $this->span,
            'bbox' => (string)$this->boundingBox,
            'z' => (string)$this->zoom,
            'size' => (string)$this->size,
            'scale' => (string)$this->scale,
            'pt' => implode('~', $this->placemarks),
            'pl' => implode('~', $this->figures),
            'lang' => $this->language?->value,
            'style' => $this->style,
            'theme' => $this->theme?->value,
            'maptype' => $this->mapType?->value,
        ], static function (?string $value): bool {
            return $value !== null && $value !== '';
        });
    }

    private function errorMessage(Response $response): string
    {
        $default = 'Yandex Static API Error';

        if ($response->header('Content-Type') === 'text/xml') {
            $message = Str::match('/<message>(.*?)<\/message>/u', $response->body());

            return $message === ''
                ? $default
                : "{$default}: {$message}";
        }

        return $default;
    }
}
