    <div class="py-2">
        <a href="{{ route('products.show', $product->id) }}" class="product-image d-block">
            <img src="@image($product->image)" class="card-img mb-3" alt="...">
        </a>
        <p class="product-name fw-semibold mb-0 d-flex align-items-center justify-content-between">
            {{ $product->name }}
            <span class="float-end text-warning fs-12">
                {{ $product->averageRating }}
                <i class="ri-star-s-fill align-middle ms-1 d-inline-block"></i>
            </span>
        </p>
        @foreach ($product->productFeatures as $productFeature)
            @if ($productFeature->feature->name === 'Color')
                <p class="my-2 d-flex align-items-center">
                    @foreach ($productFeature->details->take(3) as $detail)
                        <a class="product-colors selected me-1" href="javascript:void(0)"
                            style="color: {{ $detail->content }};">
                            <i class="ri-checkbox-blank-circle-fill"></i>
                        </a>
                    @endforeach

                    @if ($productFeature->details->count() > 3)
                        <span class="ms-1 d-flex align-items-center">
                            <span class="badge bg-light border text-muted px-2 py-1" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="View all available colors on the product details page">
                                More Colors
                            </span>
                        </span>
                    @endif
                </p>
            @endif
        @endforeach

        <p class="fw-semibold fs-16 d-flex align-items-center justify-content-between">
            <span>
                {{ $product?->productFeatureItemPrice?->product_price }}$
            </span>
            <span class="fs-12 text-success fw-semibold mb-0 d-flex align-items-center ms-0">
                <i class="ti ti-discount-2 fs-16 me-1"></i>@lang('dashboard.items count')
                {{ $product?->productItemCount }}

            </span>
            <span class="my-2 d-flex align-items-center">
                <x-buttons.show-button tooltipTitle="Show All Items" :route="route('categories.edit', $product->id)" />
            </span>
        </p>
    </div>
