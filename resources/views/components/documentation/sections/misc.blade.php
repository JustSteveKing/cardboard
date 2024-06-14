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
        The <code>/api/v1/products</code> endpoint returns {{config('app.products_pagination_amount')}} items per request.
        This means you could update ~{{\App\Models\Product::count()}} product prices in ~{{ round(\App\Models\Product::count()/(config('app.products_pagination_amount')*config('app.api_rate_limit')))}} minutes.
    </p>
</div>
