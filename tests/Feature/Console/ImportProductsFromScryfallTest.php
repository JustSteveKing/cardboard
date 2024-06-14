<?php

declare(strict_types=1);

use App\Console\Commands\ImportProductsFromScryfall;
use App\Jobs\Products\DownloadCardData;
use Illuminate\Support\Facades\Bus;
use function Pest\Laravel\artisan;

test('the command can run', function (): void {
    Bus::fake();

    artisan(
        command: ImportProductsFromScryfall::class,
    )->assertOk();
});

test('the command will dispatch the download card job', function (): void {
    Bus::fake();

    artisan(
        command: ImportProductsFromScryfall::class,
    )->assertOk();

    Bus::assertDispatched(
        command: DownloadCardData::class,
    );
});
