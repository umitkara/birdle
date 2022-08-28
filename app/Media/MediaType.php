<?php

namespace App\Media;

class MediaType
{
    public static array $image = [
        'image/jpeg',
        'image/png',
        'image/jpg',
    ];

    public static array $video = [
        'video/mp4',
    ];

    public static function type($mime): ?string
    {
        if (in_array($mime, self::$image)) {
            return 'image';
        }
        if (in_array($mime, self::$video)) {
            return 'video';
        }

        return null;
    }

    public static function all() : array
    {
        return array_merge(self::$image, self::$video);
    }
}
