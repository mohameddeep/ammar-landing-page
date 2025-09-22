@extends('dashboard.core.app')
@section('title', __('dashboard.products'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.products') }}" :breadcrumbs="[['name' => __('dashboard.products'), 'route' => 'products.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.products')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <button class="btn btn-outline-primary btn-wave waves-effect waves-light me-1" data-bs-toggle="modal"
                            data-bs-target="#c">
                            <i class="ti ti-search"></i>
                        </button>

                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.type')</th>
                            <th>@lang('dashboard.category')</th>
                            <th>@lang('dashboard.price')</th>
                            <th>@lang('dashboard.is_stopped')</th>
                            <th>@lang('dashboard.activation')</th>
                            <th>@lang('dashboard.status')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr id="row-{{ $product->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{$product->images->first()->image}}" alt="product image" width="60" height="60">
                                </td>

                                <td>{{ $product->name }}</td>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product?->category->t('name') }}</td>
                                <td>{{ $product->price }}</td>

                                <td>
                                    @if ($product->is_stopped)
                                        <span class="badge bg-danger">@lang('dashboard.stopped')</span>
                                    @else
                                        <span class="badge bg-success">@lang('dashboard.running')</span>
                                    @endif
                                </td>


                                {{-- is_active toggle --}}
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="active_toggle_{{ $product->id }}"
                                            name="active_toggleswitch_{{ $product->id }}" type="checkbox"
                                            {{ $product->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleproductStatus({{ $product->id }})">
                                        <label for="active_toggle_{{ $product->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ $product->status == 'approved' ? __('dashboard.accepted') : __('dashboard.rejected') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="changeProductStatus({{ $product->id }}, 'approved')">
                                                    @lang('dashboard.accepted')
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="changeProductStatus({{ $product->id }}, 'rejected')">
                                                    @lang('dashboard.rejection')
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>


                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.delete-button :route="route('dashboard.products.destroy', $product->id)" :itemId="$product->id" />

                                            <x-buttons.show-button
                                            :route="route('dashboard.products.details', $product->id)" :tooltip-title="__('dashboard.product-variants')" />
                                    </div>
                                </td>
                            </tr>

                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse

                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $products->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleproductStatus(productId) {
            let checkbox = document.getElementById(`toggle_${productId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('dashboard.products.toggle', ['id' => '__id__']) }}`.replace('__id__', productId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: isChecked
                },
                success: function(response) {
                    console.log(response.message);

                    if (response.data && response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });

                    }
                },

                error: function(xhr, status, error) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox.checked = !isChecked;
                }
            });
        }


        function changeProductStatus(productId, status) {
            $.ajax({
                url: `/dashboard/products/${productId}/change-status`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    $(`#dropdownMenuButton${productId}`).text(response.new_status_text);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    </script>
@endpush
