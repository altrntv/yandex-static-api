# Yandex Static API for Laravel

A simple and fluent PHP client for working with
the [Yandex Static Maps API](https://yandex.com/maps-api/products/static-api), built for Laravel. Generate static map
images with points, figures, zoom levels, and themes — all via a fluent, expressive interface.

## Installation

Install the package via Composer:

```bash
composer require altrntv/yandex-static-api
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=yandex-static-api-config
```

This will create a config/yandex-static-api.php file:

```php
return [
    'api_key' => env('YANDEX_STATIC_API_KEY'),
    'url' => env('YANDEX_STATIC_API_URL', 'https://static-maps.yandex.ru'),
];
```

Then, set your API key in the .env file:

```dotenv
YANDEX_STATIC_API_KEY="api_key"
```

## Usage

You can fluently build a map request using the provided methods.

```php
use Altrntv\YandexStaticApi\StaticApi;

$point = new Point(longitude: 32.810152, latitude: 39.889847);

$image = StaticApi::make($point)
    ->boundingBox(new BoundingBox(
        new Point(longitude: 32.810152, latitude: 39.889847),
        new Point(longitude: 32.810152, latitude: 39.889847),
    ))
    ->figures([
        new Line(
            coordinates: [32.810152, 39.889847, 32.810152, 39.889847],
            lineColor: '00FF00A0',
            lineWidth: 1,
            borderColor: '00FF00A0',
            borderWidth: 2,
        ),
    ])
    ->language(Language::RussianRussia)
    ->mapType(MapType::Map)
    ->placemarks([
        new Placemark(
            longitude: 32.810152,
            latitude: 39.889847,
            style: PlacemarkStyle::Pm,
            color: PlacemarkColor::Pink,
            size: PlacemarkSize::Large,
            content: 100,
        ),
    ])
    ->scale(1)
    ->size(new Size(width: 650, height: 450))
    ->span(10, 10)
    ->theme(Theme::Light)
    ->zoom(10)
    ->sendRequest();
```

## Supported Parameters

| Parameter     | Description                                                                                          | Example                                                                                                                                                |
|---------------|------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------|
| `point`       | Longitude and latitude of the map center in degrees.                                                 | `new Point(longitude: 32.810152, latitude: 39.889847)`                                                                                                 |
| `boundingBox` | Alternative method for setting the map viewport. Defined as lower-left and upper-right coordinates.  | `new BoundingBox(new Point(...), new Point(...))`                                                                                                      |
| `span`        | Range of the map viewport by longitude and latitude (in degrees).                                    | `->span(10)`                                                                                                                                           |
| `zoom`        | Map zoom level (0–21).                                                                               | `->zoom(10)`                                                                                                                                           |
| `size`        | Height and width of the requested map image (in pixels).                                             | `new Size(width: 650, height: 450)`                                                                                                                    |
| `scale`       | Coefficient for scaling map objects. Fractional values from 1.0 to 4.0.                              | `->scale(1)`                                                                                                                                           |
| `placemarks`  | Definitions of one or more markers, including coordinates, style, color, size, and optional content. | `[new Placemark(longitude: 32.81, latitude: 39.88, style: PlacemarkStyle::Pm, color: PlacemarkColor::Pink, size: PlacemarkSize::Large, content: 100)]` |
| `figures`     | Geometric figures (polylines and polygons) with coordinates, line color/thickness, and fill color.   | `[new Line(coordinates: [...], lineColor: '00FF00A0', lineWidth: 1, borderColor: '00FF00A0', borderWidth: 2), new Polygon(...)]`                       |
| `language`    | Map localization.                                                                                    | `Language::RussianRussia`                                                                                                                              |
| `style`       | Map styling and customization of objects’ appearance                                                 | `tags.any:poi;transit_location\|elements:label.text.fill\stylers.color:DD0000`                                                                         |                                                                                                                                                      |
| `theme`       | Theme of the requested map image (`light` or `dark`).                                                | `Theme::Light`                                                                                                                                         |
| `mapType`     | Predefined map style modes (`map`, `driving`, `transit`, `admin`).                                   | `MapType::Map`                                                                                                                                         |

## Testing

```bash
composer test
```

## Contributing

Contributions are welcome! If you’d like to improve this package, please fork the repository and open a pull request.
Bug fixes, new features, and documentation improvements are all appreciated.

## Credits

- [Pavel Dykin](https://github.com/altrntv)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
