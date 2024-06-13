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
    <body class="bg-white text-slate-900 min-h-screen w-screen antialiased flex">
        <aside class="bg-gray-100 w-1/6 p-8">
            <h2 class="font-bold text-2xl">Reference</h2>
            <ul>
                <li>
                    <x-documentation.reference-link href="#authentication">Misc.</x-documentation.reference-link>
                    <ul class="ml-4">
                        <li>
                            <x-documentation.subreference-link href="#updates">Updates</x-documentation.subreference-link>
                        </li>
                        <li>
                            <x-documentation.subreference-link href="#rate-limiting">Rate Limits</x-documentation.subreference-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <x-documentation.reference-link href="#authentication">Authentication</x-documentation.reference-link>
                    <ul class="ml-4">
                        <li>
                            <x-documentation.subreference-link href="#register">Register</x-documentation.subreference-link>
                        </li>
                        <li>
                            <x-documentation.subreference-link href="#login">Login</x-documentation.subreference-link>
                        </li>
                    </ul>
                </li>
                <li>
                     <x-documentation.reference-link href="#data">Data</x-documentation.reference-link>
                     <ul class="ml-4">
                         <li>
                             <x-documentation.subreference-link href="#products">Products</x-documentation.subreference-link>
                         </li>
                         <li>
                             <x-documentation.subreference-link href="#product">Product</x-documentation.subreference-link>
                         </li>
                     </ul>
                 </li>
            </ul>
        </aside>
        <main class="max-w-5xl mx-auto p-8 w-5/6">

            <h1 class="text-4xl font-bold mb-8">Cardboard API Documentation</h1>

            <div class="flex flex-col space-y-8">
                <section class="space-y-4" id="authentication">
                    <h2 class="text-2xl font-semibold">Misc.</h2>

                    <div class="flex flex-col space-y-2">
                        <h3 class="text-lg font-semibold">Pricing Updates</h3>
                        <p>
                            As this API is public, open source, and free - we are able to offer daily pricing updates.
                        </p>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <h3 class="text-lg font-semibold">Rate Limiting</h3>
                        <p>
                            The API allows for 60 requests per minute from a given user/IP address.
                            The <code>/api/v1/products</code> endpoint returns 100 items per request.
                            This means you could update ~150,000 product prices in ~30 minutes.
                        </p>
                    </div>
                </section>
                <section class="space-y-4" id="authentication">
                    <h2 class="text-2xl font-semibold">Authentication</h2>

                    <!--  -->

                    <div class="flex flex-col space-y-2 gap-4" id="register">
                        <div class="flex gap-4">
                            <x-documentation.section-header>Register</x-documentation.section-header>
                            <x-pill theme="success">POST</x-pill>
                        </div>
                        <x-documentation.section-description>Create and account and recieve a Bearer token</x-documentation.section-description>
                        <x-documentation.section-subheader>Required Fields</x-documentation.section-subheader>

                        <!-- Email -->
                        <div class="flex flex-col gap-2 justify-center">
                            <div class="flex gap-2 items-center">
                                <x-pill>Name</x-pill>
                                <x-documentation.parameter-type>string</x-documentation.parameter-type>
                            </div>
                            <x-documentation.parameter-description>The name we should address you by</x-documentation.parameter-description>
                            <hr />
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col gap-2 justify-center">
                            <div class="flex gap-2 items-center">
                                <x-pill>email</x-pill>
                                <x-documentation.parameter-type>string</x-documentation.parameter-type>
                            </div>
                            <x-documentation.parameter-description>The email address you would like associated with your account</x-documentation.parameter-description>
                            <hr />
                        </div>

                        <!-- Password -->
                        <div class="flex flex-col gap-2 justify-center">
                            <div class="flex gap-2 items-center">
                                <x-pill>password</x-pill>
                                <x-documentation.parameter-type>string</x-documentation.parameter-type>
                            </div>
                            <x-documentation.parameter-description>The password for your account</x-documentation.parameter-description>
                            <hr />
                        </div>

                        <!-- Token Name-->
                        <div class="flex flex-col gap-2 justify-center">
                            <div class="flex gap-2 items-center">
                                <x-pill>token_name</x-pill>
                                <x-documentation.parameter-type>string</x-documentation.parameter-type>
                            </div>
                            <x-documentation.parameter-description>The name for the token that will be created and returned to you</x-documentation.parameter-description>
                            <hr />
                        </div>
                    </div>

                    <!--  -->
<!--
                    <div class="flex flex-col space-y-2" id="login">
                        <h3 class="text-lg font-semibold">Login</h3>
                        <p>
                            Send a POST request to <code class="bg-gray-100 px-2 rounded">/api/login</code> with:
                        </p>
                        <ul class="bg-gray-100 p-4 rounded">
                            <li>email (string)</li>
                            <li>password (string)</li>
                        </ul>
                        <p>
                            This will return a Bearer token that you should include as a header on each request to the API.
                            <code class="bg-gray-100 px-2 rounded">Authorization: Bearer token-here</code>
                        </p>
                    </div> -->

                </section>

                <!-- <section class="space-y-4" id="data">
                    <h2 class="text-2xl font-semibold">Products</h2>
                    <div class="flex flex-col space-y-2" id="products">
                        <h3 class="text-lg font-semibold">Products</h3>
                        <p>
                            Send a POST request to <code class="bg-gray-100 px-2 rounded">/api/v1/products</code>.
                            This will return a collection of Products. Use their UUIDs to get individual pricing as noted below.
                            This endpoint is paginated with 100 items and rate limited.
                        </p>
                    </div>

                    <div class="flex flex-col space-y-2" id="product">
                        <h3 class="text-lg font-semibold">Product</h3>
                        <p>
                            Send a POST request to <code class="bg-gray-100 px-2 rounded">/api/v1/product</code> with the UUID of the product.
                            This will return a Product for the given UUID.
                        </p>
                        <ul class="bg-gray-100 p-4 rounded">
                            <li>uuid (string)</li>
                        </ul>
                    </div>
                </section> -->
            </div>
        </main>
    </body>
</html>
