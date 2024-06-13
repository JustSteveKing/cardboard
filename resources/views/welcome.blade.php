<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{config('app.url')}}" />

    <title>{{config('app.name')}}</title>

    @vite('resources/css/app.css')

</head>
    <body class="bg-white text-slate-900 min-h-screen w-screen antialiased p-8">
        <main class="max-w-5xl mx-auto flex flex-col gap-8">

            <h1 class="text-4xl font-bold">Cardboard API</h1>

            <div class="flex flex-col gap-4">
                <h2 class="text-2xl font-normal">Authentication</h2>
                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-light ">Rate Limiting</h3>
                    <p>
                        The API allows for 60 requests per minute from a given user/ip address.
                        The <code>/api/v1/products</code> endpoint returns 100 items per request
                        This means you could update ~150,000 product prices in ~30 minutes.
                    </p>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-light ">Registration</h3>
                    <p>
                        Send a post request to <code>{{config('app.url')}}/api/register</code> with:
                        <ul class="bg-gray-100 p-4 w-1/2 rounded">
                            <li>name (string)</li>
                            <li>email (string)</li>
                            <li>password (string)</li>
                            <li>token_name (string)</li>
                        </ul>
                        This will return a Bearer token that you should include as a header on each request to the api.
                        <code>Authorization : Bearer token-here</code>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-light ">Login</h3>
                    <p>
                        Send a post request to <code>{{config('app.url')}}/api/login</code> with:
                        <ul class="bg-gray-100 p-4 w-1/2 rounded">
                            <li>email (string)</li>
                            <li>password (string)</li>
                        </ul>
                        This will return a Bearer token that you should include as a header on each request to the api.
                        <code>Authorization : Bearer token-here</code>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-light">Products</h3>
                    <p>
                        Send a post request to <code>{{config('app.url')}}/api/v1/products</code>
                        This will return a collection of Products. Use their UUIDs to get individual pricing as noted below.
                        This endpoint is paginated with 100 items and rate limited
                    </p>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-light">Product</h3>
                    <p>
                        Send a post request to <code>{{config('app.url')}}/api/v1/product</code> with the uuid of the product
                        This will return a Product for the given uuid
                        <ul class="bg-gray-100 p-4 w-1/2 rounded">
                            <li>uuid (string)</li>
                        </ul>
                    </p>
                </div>
            </div>

        </main>
    </body>
</html>
