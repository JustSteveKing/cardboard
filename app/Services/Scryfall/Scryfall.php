<?php

declare(strict_types=1);

namespace App\Services\Scryfall;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Throwable;

final class Scryfall
{
    public function __construct(
        private PendingRequest $request,
    ) {
    }

    /**
     * @return Collection<BulkData>
     * @throws ScryfallException
     */
    public function bulkData(): Collection
    {
        try {
            $response = $this->request->get(
                url: 'bulk-data',
            );
        } catch (Throwable $exception) {
            throw new ScryfallException(
                message: $exception->getMessage(),
                code: $exception->getCode(),
                previous: $exception,
            );
        }

        return $response->collect('data')->map(
            callback: fn (array $data): BulkData => BulkData::fromArray(
                data: $data,
            ),
        );
    }
}
