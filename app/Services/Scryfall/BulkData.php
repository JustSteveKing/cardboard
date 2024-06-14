<?php

declare(strict_types=1);

namespace App\Services\Scryfall;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

final readonly class BulkData
{
    public function __construct(
        public string $object,
        public string $id,
        public string $type,
        public CarbonInterface $updated_at,
        public string $uri,
        public string $name,
        public string $description,
        public int $size,
        public string $download_uri,
        public string $content_type,
        public string $content_encoding,
    ) {
    }

    public static function fromArray(array $data): BulkData
    {
        return new BulkData(
            object:  $data['object'],
            id: $data['id'],
            type: $data['type'],
            updated_at: Carbon::parse(
                time: $data['updated_at'],
            ),
            uri: $data['uri'],
            name: $data['name'],
            description: $data['description'],
            size: $data['size'],
            download_uri: $data['download_uri'],
            content_type: $data['content_type'],
            content_encoding: $data['content_encoding'],
        );
    }
}
