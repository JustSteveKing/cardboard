<?php

declare(strict_types=1);

namespace App\Http\Responses\API\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final readonly class CollectionResponse implements Responsable
{
    public function __construct(
        private AnonymousResourceCollection $data,
        private string $key,
        private array $headers = [],
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
            ],
            headers: $this->headers,
        );
    }
}
