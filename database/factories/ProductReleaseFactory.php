<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductRelease;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class ProductReleaseFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = ProductRelease::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->word,
            'external_id' => $this->faker->uuid(),
        ];
    }
}
