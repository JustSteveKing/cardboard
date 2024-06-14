<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('api_requests', static function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->longText('path')->nullable();
            $table->longText('params')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_requests');
    }
};
