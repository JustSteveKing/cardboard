<?php

declare(strict_types=1);

use App\Enums\ProductCategories;
use App\Enums\ProductFranchises;
use App\Enums\ProductProviders;
use App\Models\ProductRelease;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table): void {
            $table->id();
            $table->uuid()->nullable()->index();

            $table->string('name')->index();
            $table->string('category')->default(ProductCategories::CARD->value);
            $table->string('franchise')->default(ProductFranchises::MAGIC->value);
            $table->string('provider')->default(ProductProviders::SCRYFALL->value);
            $table->text('description')->nullable();
            $table->text('external_id')->nullable();
            $table->text('image_path')->nullable();

            $table->foreignIdFor(ProductRelease::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
