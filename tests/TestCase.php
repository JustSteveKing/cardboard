<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();

        Http::fake(
            callback: [
                'https://api.scryfall.com/bulk-data' => Http::response(
                    body: file_get_contents(
                        filename: base_path(
                            path: 'tests/Fixtures/scryfall/bulk-data.json',
                        ),
                    ),
                    status: Response::HTTP_OK,
                ),
            ],
        );
    }
}
