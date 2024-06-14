<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\Products\DownloadCardData;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductRelease;
use App\Services\MoneyService;
use App\Services\Scryfall\Scryfall;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use function storage_path;

use Symfony\Component\Console\Attribute\AsCommand;
use Throwable;

#[AsCommand(name: 'import:scryfall', description: 'Import All Cards & Prices from Scryfall.')]
final class ImportProductsFromScryfall extends Command
{
    public function handle(Scryfall $scryfall, Dispatcher $bus): void
    {
        \Laravel\Prompts\info(
            message: 'Getting all product and prices from Scryfall',
        );

        $this->info('Preparing Default Cards');

        foreach ($scryfall->bulkData() as $data) {
            try {
                File::makeDirectory(
                    path: storage_path(
                        path: 'data/magic',
                    ),
                );
            } catch (Throwable $exception) {
                Log::error($exception->getMessage(), ['exception' => $exception]);
            }

            \Laravel\Prompts\info(
                message: "Getting data for: {$data->type}",
            );

            $bus->dispatch(
                command: new DownloadCardData(
                    data: $data,
                    path: storage_path(
                        path: "data/magic/{$data->type}.json",
                    ),
                ),
            );
        }
        //
        //        $this->info('Preparing Unique Cards');
        //
        //        FileService::generateFolderAndFile(folder: storage_path() . '/data/magic/', file: 'unique-cards.json');
        //
        //        ProductService::downloadScryfallCardData(uri: $uniqueLink, filePath: storage_path() . '/data/magic/unique-cards.json');
        //
        //        $franchise = ProductFranchise::where('slug', 'magic')->first();
        //
        //        $category = ProductCategory::where('slug', 'card')->first();
        //
        //        $provider = ProductProvider::where('name', 'scryfall')->first();
        //
        //        $default = Items::fromFile(storage_path() . '/data/magic/default-cards.json');
        //
        //        $unique = Items::fromFile(storage_path() . '/data/magic/unique-cards.json');
        //
        //        foreach ($default as $id => $card) {
        //            $this->createProduct($card, $franchise, $category, $provider);
        //        }
        //
        //        foreach ($unique as $id => $card) {
        //            $this->createProduct($card, $franchise, $category, $provider);
        //        }
    }

    public function createProduct($card, ProductFranchise $franchise, ProductCategory $category, ProductProvider $provider): void
    {
        if ('en' !== $card->lang) {
            return;
        }

        $product = Product::where('product_provider_external_id', $card->id)
            ->where('product_provider_id', $provider->id)
            ->where('product_franchise_id', $franchise->id)
            ->withTrashed()
            ->first();

        if ($product) {

            $this->info("Product {$card->name} already exists");

            $this->createProductPrice(price: $card->prices->usd_foil, product: $product, finish: $this->foil);

            $this->createProductPrice(price: $card->prices->usd, product: $product, finish: $this->nonFoil);

            $this->createProductPrice(price: $card->prices->usd_etched, product: $product, finish: $this->etched);
            // $this->importImage($product, $card);

            return;
        }

        $release = ProductRelease::where('name', $card->set_name)->where('code', $card->set)->first();

        if ( ! $release) {
            $release = ProductRelease::create([
                'name' => $card->set_name,
                'code' => $card->set,
                'product_provider_external_id' => $card->set_id,
            ]);
        }

        $product = Product::create([
            'product_franchise_id' => $franchise->id,
            'product_category_id' => $category->id,
            'product_provider_id' => $provider->id,
            'product_release_id' => $release?->id ?? null,
            'product_provider_external_id' => $card->id,
            'name' => $card->name ?? null,
            'description' => $card->oracle_text ?? null,
        ]);

        if ( ! $product) {
            $this->error('Could not create product');

            return;
        }

        $this->createProductPrice(price: $card->prices->usd_foil, product: $product, finish: $this->foil);

        $this->createProductPrice(price: $card->prices->usd, product: $product, finish: $this->nonFoil);

        $this->createProductPrice(price: $card->prices->usd_etched, product: $product, finish: $this->etched);

        // $this->importImage($product, $card);

    }

    private function createProductPrice($price, Product $product, ProductFinish $finish): void
    {
        $amount = MoneyService::convertToSmallestUnit($price);

        if (blank($amount)) {
            return;
        }

        ProductPrice::create([
            'price' => $amount,
            'product_id' => $product->id,
            'product_finish_id' => $finish->id,
        ]);
    }

    private function importImage(Product $product, $card): void
    {
        //TODO
    }
}
