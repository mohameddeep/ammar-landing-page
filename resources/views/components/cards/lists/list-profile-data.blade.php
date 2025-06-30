<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex flex-column flex-sm-row align-items-start gap-4">

        <div class="flex-shrink-0">
            @if (isset($recevedData->image) && $recevedData->image)
                <span
                    class="avatar avatar-xl avatar-rounded {{ $recevedData->is_active == 1 ? 'online' : 'offline' }} overflow-hidden">
                    <img src="@image($recevedData->image)" alt="img" class="img-fluid">
                </span>
            @else
                <div
                    class="avatar avatar-xl avatar-rounded {{ $recevedData->is_active == 1 ? 'online' : 'offline' }} d-flex align-items-center justify-content-center bg-light text-primary">
                    <img src="{{ $recevedData?->type?->icon() }}" alt="Product Icon" class="me-2">
                </div>
            @endif

        </div>

        <div class="flex-grow-1">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <div class="d-flex align-items-center flex-wrap gap-2">

                    <h5 class="fw-bold mb-0 text-dark">{{ $recevedData->t('name') }}
                        <span class="badge ms-2 {{ $recevedData?->type?->color() }}">
                            <span>{{ $recevedData?->type?->t() }}</span>
                        </span>
                    </h5>
                </div>

                <div class="text-muted fw-semibold">
                    {{ $recevedData->price }}
                    <img src="{{ asset('icons/Saudi_Riyal_Symbol.svg') }}" alt="Product Icon" class="me-2">
                    / {{ $recevedData->duration }} @lang('dashboard.days')
                </div>
            </div>

            <div class="mb-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded-2 p-3 h-100 d-flex flex-column justify-content-center bg-light">
                            <div class="d-flex align-items-center mb-1">
                                <i class="ri-stack-line text-primary me-2 fs-5"></i>
                                <span class="text-muted small">@lang('dashboard.number')</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $recevedData->product_number }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-2 p-3 h-100 d-flex flex-column justify-content-center bg-light">
                            <div class="d-flex align-items-center mb-1">
                                <i class="ri-gift-line text-success me-2 fs-5"></i>
                                <span class="text-muted small">@lang('dashboard.free product')</span>
                            </div>
                            <div class="fw-bold fs-5">{{ $recevedData->free_product_count }}</div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- الوصف --}}
            <div class="pt-2 border-top mt-3">
                <div class="text-muted small mb-1">الوصف</div>
                <p class="mb-0">{{ $recevedData->t('description') }}</p>
            </div>

        </div>

    </div>
</div>
