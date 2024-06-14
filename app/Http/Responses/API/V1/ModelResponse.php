<?php

declare(strict_types=1);

namespace App\Http\Responses\API\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

final readonly class ModelResponse implements Responsable
{
    public function __construct(
        private JsonResource $data,
        private string $key,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
            ],
        );
    }
}
