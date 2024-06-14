<?php

declare(strict_types=1);

namespace App\Jobs\Products;

use App\Services\Scryfall\BulkData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

final class DownloadCardData implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly BulkData $data,
        public readonly string $path,
    ) {
    }

    public function handle(): void
    {
        File::put(
            path: $this->path,
            contents: file_get_contents(
                filename: $this->data->download_uri,
            ),
        );
    }
}
