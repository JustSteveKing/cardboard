<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFranchise;
use App\Models\ProductProvider;
use App\Models\ProductRelease;
use App\Services\FileService;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use JsonMachine\Items;

class ImportProductsFromScryfall extends Command
{
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

            $this->importImage($product, $card);

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

        // $this->updateProductPrice($card, $product);

        // $this->importImage($product, $card);

    }

    private function updateProductPrice($card, Product $product): void
    {
        //TODO: Create a product price model and add an entry for each price
        //      Consider adding a product for each finishes price
    }

    private function importImage(Product $product, $card)
    {

        //Get image_uris off of card

        // if ($product->image_name) {
        //     $this->info('Has image already');

        //     return;
        // }

        // $decoded = (object) json_decode($attribute->value, true);

        // $imageUrl = null;

        // $imageUrl = $this->getImageURL($decoded);

        // $this->info("Checking {$product->name}");

        // if ($imageUrl) {

        //     $this->warn("Downloading image for {$product->name}");

        //     $contents = Http::get($imageUrl);

        //     $type = $contents->headers()['Content-Type'][0];

        //     $extension = explode('/', $type)[1];

        //     $hash = Str::ascii(Str::random(16)).$product->id;

        //     $fileName = "{$hash}.{$extension}";

        //     $product->update([
        //         'image_path' => $fileName,
        //     ]);

        //     $status = Storage::put("{$fileName}", $contents, 'public');

        //     if ($status) {
        //         try {
        //             $product->update([
        //                 'image_path' => $fileName,
        //             ]);

        //         } catch (\Exception $e) {

        //             echo $e->getMessage();

        //             logger()->error($e->getMessage());

        //             return;
        //         }

        //         return;
        //     } else {
        //         echo "Failed to download image for {$product->name}";
        //     }

        // }
    }

    private function getImageURL($imageUris): ?string
    {
        return
            $imageUris->normal ??
            $imageUris->png ??
            $imageUris->large ??
            $imageUris->art_crop ??
            $imageUris->small ??
            $imageUris->border_crop;
    }

    private function getDoubleSidedCardURL($card): ?string
    {
        return
            $card->card_faces[0]->image_uris->normal ??
            $card->card_faces[0]->image_uris->png ??
            $card->card_faces[0]->image_uris->large ??
            $card->card_faces[0]->image_uris->art_crop ??
            $card->card_faces[0]->image_uris->small ??
            $card->card_faces[0]->image_uris->border_crop;
    }
}
