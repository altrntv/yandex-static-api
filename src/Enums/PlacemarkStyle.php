<?php

namespace Altrntv\YandexStaticApi\Enums;

enum PlacemarkStyle: string
{
    case Pm = 'pm';
    case Pm2 = 'pm2';
    case Flag = 'flag';
    case Vk = 'vk';
    case Org = 'org';
    case Comma = 'comma';
    case Round = 'round';
    case Home = 'home';
    case Work = 'work';
    case YaRu = 'ya_ru';
    case YaEn = 'ya_en';

    public function validateColor(?PlacemarkColor $color): ?PlacemarkColor
    {
        return in_array($color, $this->colors(), true)
            ? $color
            : null;
    }

    public function validateSize(?PlacemarkSize $size): ?PlacemarkSize
    {
        return in_array($size, $this->sizes(), true)
            ? $size
            : null;
    }

    /**
     * @return PlacemarkColor[]
     */
    private function colors(): array
    {
        return match ($this) {
            self::Pm => [
                PlacemarkColor::White,
                PlacemarkColor::DarkOrange,
                PlacemarkColor::DarkBlue,
                PlacemarkColor::Blue,
                PlacemarkColor::Green,
                PlacemarkColor::Gray,
                PlacemarkColor::LightBlue,
                PlacemarkColor::DarkNight,
                PlacemarkColor::Orange,
                PlacemarkColor::Pink,
                PlacemarkColor::Red,
                PlacemarkColor::Violet,
                PlacemarkColor::Yellow,
                PlacemarkColor::LetterA,
                PlacemarkColor::LetterB,
            ],

            self::Pm2 => [
                PlacemarkColor::White,
                PlacemarkColor::DarkOrange,
                PlacemarkColor::DarkBlue,
                PlacemarkColor::Blue,
                PlacemarkColor::Green,
                PlacemarkColor::Gray,
                PlacemarkColor::LightBlue,
                PlacemarkColor::DarkNight,
                PlacemarkColor::Orange,
                PlacemarkColor::Pink,
                PlacemarkColor::Red,
                PlacemarkColor::Violet,
                PlacemarkColor::Yellow,
                PlacemarkColor::LetterA,
                PlacemarkColor::LetterB,
                PlacemarkColor::DarkGreen,
                PlacemarkColor::Org,
                PlacemarkColor::Dir,
                PlacemarkColor::BlueYellowDot,
            ],

            self::Vk => [
                PlacemarkColor::Black,
                PlacemarkColor::Gray,
            ],

            default => [],
        };
    }

    /**
     * @return PlacemarkSize[]
     */
    private function sizes(): array
    {
        return match ($this) {
            self::Pm => [
                PlacemarkSize::Small,
                PlacemarkSize::Medium,
                PlacemarkSize::Large,
            ],

            self::Pm2 => [
                PlacemarkSize::Medium,
                PlacemarkSize::Large,
            ],

            self::Vk => [
                PlacemarkSize::Medium,
            ],

            default => [],
        };
    }
}
