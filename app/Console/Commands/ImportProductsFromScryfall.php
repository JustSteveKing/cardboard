<?php

namespace App\Console\Commands;

use App\Enums\ProductFinishes;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFinish;
use App\Models\ProductFranchise;
use App\Models\ProductPrice;
use App\Models\ProductProvider;
use App\Models\ProductRelease;
use App\Services\FileService;
use App\Services\MoneyService;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use JsonMachine\Items;

class ImportProductsFromScryfall extends Command
{
    private ProductFinish $nonFoil;

    private ProductFinish $foil;

    private ProductFinish $etched;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:scryfall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import All Cards & Prices from Scryfall';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->nonFoil = ProductFinish::where('slug', ProductFinishes::NONFOIL->value)->get()->first();

        $this->foil = ProductFinish::where('slug', ProductFinishes::FOIL->value)->get()->first();

        $this->etched = ProductFinish::where('slug', ProductFinishes::ETCHED->value)->get()->first();

        $this->info('Getting all Products and Prices from Scryfall');

        $this->info('Preparing Default Cards');

        $bulks = (Http::get('https://api.scryfall.com/bulk-data')->json());

        $defaultLink = collect($bulks['data'])->filter(fn ($item) => $item['type'] == 'default_cards')?->first()['download_uri'];

        $uniqueLink = collect($bulks['data'])->filter(fn ($item) => $item['type'] == 'unique_artwork')?->first()['download_uri'];

        FileService::generateFolderAndFile(folder: storage_path().'/data/magic/', file: 'default-cards.json');

        ProductService::downloadScryfallCardData(uri: $defaultLink, filePath: storage_path().'/data/magic/default-cards.json');

        $this->info('Preparing Unique Cards');

        FileService::generateFolderAndFile(folder: storage_path().'/data/magic/', file: 'unique-cards.json');

        ProductService::downloadScryfallCardData(uri: $uniqueLink, filePath: storage_path().'/data/magic/unique-cards.json');

        $franchise = ProductFranchise::where('slug', 'magic')->first();

        $category = ProductCategory::where('slug', 'card')->first();

        $provider = ProductProvider::where('name', 'scryfall')->first();

        $default = Items::fromFile(storage_path().'/data/magic/default-cards.json');

        $unique = Items::fromFile(storage_path().'/data/magic/unique-cards.json');

        foreach ($default as $id => $card) {
            $this->createProduct($card, $franchise, $category, $provider);
        }

        foreach ($unique as $id => $card) {
            $this->createProduct($card, $franchise, $category, $provider);
        }
    }

    public function createProduct($card, ProductFranchise $franchise, ProductCategory $category, ProductProvider $provider): void
    {
        if ($card->lang !== 'en') {
            return;
        }

        $product = Product::where('product_provider_external_id', $card->id)
            ->where('product_provider_id', $provider->id)
            ->where('product_franchise_id', $franchise->id)
            ->withTrashed()
            ->first();

        if ($product) {

            $this->info("Product {$card->name} already exists");

            $this->updateProductPrice($card, $product);

            // $this->importImage($product, $card);

            return;
        }

        $release = ProductRelease::where('name', $card->set_name)->where('code', $card->set)->first();

        if (! $release) {
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

        if (! $product) {
            $this->error('Could not create product');

            return;
        }

        $this->createProductPrice(price: $card->prices->usd_foil, product: $product, finish: $this->foil);

        $this->createProductPrice(price: $card->prices->usd, product: $product, finish: $this->nonFoil);

        $this->createProductPrice(price: $card->prices->usd_etched, product: $product, finish: $this->etched);

        // $this->importImage($product, $card);

    }

    private function createProductPrice($price, Product $product, ProductFinish $finish)
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

    private function importImage(Product $product, $card)
    {
        //TODO
    }
}
