<?php

declare(strict_types=1);

use App\Enums\ProductFinishes;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('product_prices', static function (Blueprint $table): void {
            $table->id();

            $table->string('finish')->default(ProductFinishes::NONFOIL->value);

            $table->foreignIdFor(Product::class)->index()->constrained();
            $table->unsignedBigInteger('price');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
