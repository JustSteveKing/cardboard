<div class="flex flex-col space-y-2 gap-4" id="register">
    <div class="flex gap-4">
        <x-documentation.section-header>Products</x-documentation.section-header>
        <div class="flex gap-4 items-center">
            <x-pill theme="success">Get</x-pill>
            <x-documentation.endpoint>/api/v1/products</x-documentation.endpoint>
        </div>
    </div>
    <x-documentation.section-description>Get a list of products, their UUIDs, and their most recent prices for each finish</x-documentation.section-description>
    <x-documentation.section-description>Inpect the payload to see the pagination links to allow you to get the rest of the products.</x-documentation.section-description>
    <x-documentation.section-description>Alternatively, pass a 'page' property.</x-documentation.section-description>

    <x-documentation.section-subheader>Optional Fields</x-documentation.section-subheader>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>page</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The page of products to fetch</x-documentation.parameter-description>
        <hr />
    </div>

    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>uuids</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The specific uuids to fetch</x-documentation.parameter-description>
        <hr />
    </div>

    <!-- Example -->
    <x-documentation.code-sample>
        Http::get('{{config('app.url')}}/api/v1/products?uuids=abc123,def456')->json()
    </x-documentation.code-sample>
</div>
