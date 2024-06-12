<?php

namespace App\Services;

class ProductService
{
    public static function downloadScryfallCardData(string $uri, string $filePath): void
    {
        if (config('development.seed_real_data') || app()->isProduction()) {
            $data = file_get_contents($uri);

            file_put_contents($filePath, $data);
        } else {
            $cardData = file_get_contents($filePath);

            file_put_contents($filePath, $cardData);
        }
    }
}
