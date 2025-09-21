<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 p-3">
    <div class="swiper swiper-preview-details bg-light product-details-page">
        <div class="swiper-wrapper">
            @foreach ($images as $productImage)
                <div class="swiper-slide p-1" id="img-container">
                    <img class="img-fluid" src="@image($productImage->image)" alt="img">
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <div class="swiper swiper-view-details mt-2">
        <div class="swiper-wrapper">
            @foreach ($images as $productImage)
                <div class="swiper-slide">
                    <img class="img-fluid" src="@image($productImage->image)" alt="img">
                </div>
            @endforeach
        </div>
    </div>
</div>
