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
                     <x-documentation.reference-link href="#data">Data Points</x-documentation.reference-link>
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
                    <x-documentation.sections.misc/>
                </section>
                <section class="space-y-4" id="authentication">
                    <h2 class="text-2xl font-semibold">Authentication</h2>
                    <x-documentation.sections.register />
                    <x-documentation.sections.login/>
                </section>
                <section class="space-y-4" id="data">
                    <h2 class="text-2xl font-semibold">Data Points</h2>
                    <x-documentation.sections.products/>
                    <x-documentation.sections.product/>
                </section>

            </div>
        </main>
    </body>
</html>
