@extends('dashboard.core.app')
@section('css_addons')
    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

@endsection
@section('title', __('dashboard.product-variants'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.product-variants') }}" :breadcrumbs="[
            ['name' => __('dashboard.products')],
            [
                'name' => __('dashboard.product-variants'),
                'route' => 'products.index',
            ],
        ]" />
        <!-- Page Header Close -->

        <x-cards.page-card>
            <div class="row px-3 py-4">
                <div class="row my-2">
                    <x-cards.swiper.swiper :images="$product->images" />

                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-12 p-3">
                        <p class="fs-18 fw-semibold mb-0">
                            {{ $product?->name }}

                        </p>
                        <p class="fs-18 mb-4">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="ri-star-s-fill text-warning align-middle"></i>
                            @endfor

                            @if ($halfStar)
                                <i class="ri-star-half-s-fill text-warning align-middle"></i>
                            @endif

                            @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                <i class="ri-star-line text-warning align-middle"></i>
                            @endfor

                            <span class="fw-semibold text-muted ms-1">
                                {{ $rating }}
                                <a class="text-info" href="javascript:void(0);">({{ number_format($reviewsCount) }}
                                    Reviews)</a>
                            </span>
                        </p>
                        <div class="row mb-4">
                            <div class="col-xxl-3 col-xl-12">
                                <p class="mb-1 lh-1 fs-50 text-success fw-semibold">@lang('dashboard.price')</p>
                                <p class="mb-1">
                                    <span class="h3">
                                        <sup class="fs-14">$</sup>
                                        {{ number_format($product->price, 2) }}
                                        <sup class="fs-14">.00</sup>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-8 col-sm-12 mt-xxl-0 mt-3">
                                <p class="mb-2 fs-15 fw-semibold">@lang('dashboard.category')</p>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    @if ($product->category)
                                        <span class="btn btn-sm btn-outline-light text-default">
                                            {{ $product?->category->t('name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="fs-15 fw-semibold mb-1">@lang('dashboard.Description') :</p>
                            <p class="text-muted mb-0">
                                {{ $product->description }}
                            </p>
                        </div>
                      
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                     <p class="fs-15 fw-semibold mb-1">@lang('dashboard.is_stopped') :</p>
                            <p class="text-muted mb-0">
<button 
    class="btn {{ $product->is_stopped ? 'btn-danger' : 'btn-success' }}" 
    {{ $product->is_stopped ? 'disabled' : '' }}
>
    {{ $product->is_stopped ? __('dashboard.stopped') : __('dashboard.running') }}
</button>
                            </p>
                                   
                                </div>
                                <div class="col-xl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-md-0 mt-3">
                                     <p class="fs-15 fw-semibold mb-1">@lang('dashboard.activation') :</p>
                            <p class="text-muted mb-0">
                                <button 
    class="btn {{ $product->is_active ? 'btn-success' : 'btn-danger' }}" 
    {{ $product->is_active ? '' : 'disabled' }}
>
    {{ $product->is_active ? __('dashboard.active') : __('dashboard.inactive') }}
</button>
                            </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row  my-2">
                    <div class="col-xl-8 mt-xxl-0 mt-3 p-3">
                        <div class="mb-1">
                            <p class="fs-15 fw-semibold mb-2">@lang('dashboard.product-variants') :</p>
                            <div class="row">
                                <div class="col-xl-12">
                                    @foreach ($product->variants as $index => $item)
                                        @php
                                            $accordionId = 'accordionItem' . $index;
                                            $headingId = 'heading' . $index;
                                            $collapseId = 'collapse' . $index;
                                        @endphp

                                        <div class="accordion accordion-customicon1 accordion-primary p-1"
                                            id="{{ $accordionId }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="{{ $headingId }}">
                                                    <button class="accordion-button collapsed fw-semibold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                                        aria-expanded="false" aria-controls="{{ $collapseId }}">
                                                        @lang('dashboard.Item') {{ '#' . ($index + 1) }}
                                                    </button>
                                                </h2>
                                                <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                                                    aria-labelledby="{{ $headingId }}"
                                                    data-bs-parent="#{{ $accordionId }}">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless align-middle mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="text-muted"> @lang('dashboard.item_type')</th>
                                                                        <td>{{ $item->type }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="text-muted">@lang('dashboard.value')</th>
                                                                        <td>{{ $item->value }}</td>
                                                                    </tr>
                                                        
                                                                   
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mt-xxl-0 mt-3 p-3">
                        <div class="mb-1">
                            <p class="fs-15 fw-semibold mb-3">Reviews & Ratings :</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-top mb-3">
                                        <div class="me-2 lh-1">
                                            <i class="ri-star-fill fs-25 text-warning"></i>
                                        </div>
                                        <div class="lh-1">
                                            <p class="mb-1">{{ $rating }} out of 5</p>
                                            <p class="mb-0 text-muted fs-11">Based on ({{ number_format($reviewsCount) }})
                                                ratings</p>
                                        </div>
                                    </div>

                                    @foreach ([5, 4, 3, 2, 1] as $star)
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="fs-12 me-2 fw-semibold">{{ $star }}
                                                <i class="ri-star-fill fs-10"></i>
                                            </div>
                                            <div class="progress progress-xs flex-fill">
                                                <div class="progress-bar 
                                {{ $star >= 4 ? 'bg-success' : ($star == 2 ? 'bg-warning' : 'bg-danger') }}"
                                                    role="progressbar" style="width: {{ $percentages[$star] ?? 0 }}%"
                                                    aria-valuenow="{{ $percentages[$star] ?? 0 }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="text-muted ms-2 fs-12">
                                                ({{ number_format($starRatings[$star] ?? 0) }})
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </x-cards.page-card>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-details.js') }}"></script>
@endpush
