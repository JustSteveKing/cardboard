<?php

use App\Models\ProductCategory;
use App\Models\ProductFinish;
use App\Models\ProductFranchise;
use App\Models\ProductProvider;
use App\Models\ProductRelease;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable()->index();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->text('provider_external_id')->nullable();
            $table->text('image_path')->nullable();
            $table->foreignIdFor(ProductCategory::class);
            $table->foreignIdFor(ProductFinish::class);
            $table->foreignIdFor(ProductFranchise::class);
            $table->foreignIdFor(ProductProvider::class);
            $table->foreignIdFor(ProductRelease::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
