<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Scryfall\Scryfall;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            abstract: Scryfall::class,
            concrete: fn () => new Scryfall(
                request: Http::baseUrl(
                    url: 'https://api.scryfall.com',
                )->timeout(
                    seconds: 40,
                )->acceptJson(),
            ),
        );
    }

    public function boot(): void
    {
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute(config('app.api_rate_limit'))->by($request->user()?->id ?: $request->ip()));
    }
}
