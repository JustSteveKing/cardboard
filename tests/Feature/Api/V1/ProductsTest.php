<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Products\IndexController;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;

test('the products index returns the correct status code', function (): void {
    actingAs(User::factory()->create())->getJson(
        uri: action(IndexController::class),
    )->assertStatus(Response::HTTP_OK);
});

test('the response format is correct', function (): void {
    ProductPrice::factory()->count(4)->create();

    actingAs(User::factory()->create())->getJson(
        uri: action(IndexController::class),
    )->assertStatus(Response::HTTP_OK);
});


//it('has api/v1/products page', function () {
//
//    $this->seed();
//
//    $user = User::factory()->create();
//
//    $token = $user->createToken('token');
//
//    $accessToken = $token->plainTextToken;
//
//    $product = Product::factory()->create([
//        'name' => 'Fury Sliver',
//        'image_path' => null,
//        'uuid' => '142f4f38-773b-4bb6-8adb-4d733a94c578',
//    ]);
//
//    ProductPrice::factory()->create([
//        'product_id' => $product->id,
//        'product_finish_id' => 1,
//        'price' => 100,
//    ]);
//
//    ProductPrice::factory()->create([
//        'product_id' => $product->id,
//        'product_finish_id' => 2,
//        'price' => 150,
//    ]);
//
//    ProductPrice::factory()->create([
//        'product_id' => $product->id,
//        'product_finish_id' => 3,
//        'price' => 200,
//    ]);
//
//    $response = $this->postJson('/api/v1/products', [], ['Authorization' => 'Bearer '.$accessToken, 'Accepts' => 'application/json']);
//
//    $response->assertStatus(200);
//
//    $response->assertJsonStructure([
//        'data' => [
//            '*' => [
//                'uuid',
//                'type',
//                'attributes' => [
//                    'name',
//                    'image_path',
//                    'latest_prices' => [
//                        'nonfoil' => [
//                            'price',
//                            'created_at',
//                        ],
//                        'foil' => [
//                            'price',
//                            'created_at',
//                        ],
//                        'etched',
//                    ],
//                ],
//            ],
//        ],
//    ]);
//});
