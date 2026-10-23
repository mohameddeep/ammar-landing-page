@extends('dashboard.core.app')
@section('title', __('dashboard.services'))

@section('content')
    <div class="container-fluid px-4 px-lg-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.services') }}" :breadcrumbs="[['name' => __('dashboard.services'), 'route' => 'services.index']]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div>
                    <div class="card-title">@lang('dashboard.services')</div>
                    <p class="text-muted fs-12 mb-0 mt-1"><i class="ri-drag-move-2-line"></i> @lang('dashboard.services_tree_hint')</p>
                </div>
                <div class="py-2 d-flex justify-content-end align-items-center">
                    <x-buttons.create-button :route="route('services.create')" />
                </div>
            </x-slot>

            @if ($services->isEmpty())
                <p class="text-center text-muted py-5 mb-0">@lang('dashboard.no_services_yet')</p>
            @else
                <div class="svc-tree" data-sortable-list data-level="root">
                    @foreach ($services as $service)
                        <div class="svc-group" data-id="{{ $service->id }}">
                            @include('dashboard.site.services.partials.row', ['service' => $service, 'position' => $loop->iteration, 'isChild' => false])

                            <div class="svc-children" data-sortable-list data-level="{{ $service->id }}">
                                @foreach ($service->children as $child)
                                    @include('dashboard.site.services.partials.row', ['service' => $child, 'position' => $loop->iteration, 'isChild' => true])
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-cards.page-card>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleserviceStatus(serviceId) {
            let checkbox = document.getElementById(`toggle_${serviceId}`);
            let routeUrl = `{{ route('services.toggle', ['id' => '__id__']) }}`.replace('__id__', serviceId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.data && response.data.success) {
                        const badge = document.querySelector(`#row-${serviceId} [data-status-badge]`);
                        if (badge) {
                            const visible = !!response.data.is_active;
                            badge.className = 'badge ' + (visible ? 'bg-success-transparent' : 'bg-danger-transparent');
                            badge.textContent = visible ? @json(__('dashboard.status_visible')) : @json(__('dashboard.status_hidden'));
                        }
                        Swal.fire({ icon: 'success', title: response.message, toast: true, position: 'top-end', showConfirmButton: false, timer: 2500, timerProgressBar: true });
                    }
                },
                error: function(xhr, status) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox.checked = !checkbox.checked;
                }
            });
        }

        // Ordering: drag rows within the same list (main services, or the sub-services of one parent),
        // or use the up/down buttons. Each change is saved immediately.
        (function () {
            const reorderUrl = @json(route('services.reorder'));
            let dragged = null;

            // A main-service row moves its whole group (row + its children).
            const itemOf = (row) => row.classList.contains('svc-row--child') ? row : row.closest('.svc-group');
            const listOf = (item) => item.parentElement;
            const itemsIn = (list) => Array.from(list.children).filter((el) => el.matches('.svc-group, .svc-row--child'));

            function renumber(list) {
                itemsIn(list).forEach((item, i) => {
                    const pos = (item.matches('.svc-row') ? item : item.querySelector(':scope > .svc-row')).querySelector('[data-position]');
                    if (pos) pos.textContent = i + 1;
                });
            }

            function save(list) {
                renumber(list);
                const ids = itemsIn(list).map((item) => item.dataset.id);
                $.ajax({
                    url: reorderUrl,
                    type: 'POST',
                    data: { _token: $('meta[name="csrf-token"]').attr('content'), ids: ids },
                    success: function (response) {
                        Swal.fire({ icon: 'success', title: response.message, toast: true, position: 'top-end', showConfirmButton: false, timer: 1800 });
                    },
                    error: function () {
                        Swal.fire({ icon: 'error', title: @json(__('dashboard.services_order_invalid')), toast: true, position: 'top-end', showConfirmButton: false, timer: 3500 });
                    }
                });
            }

            document.addEventListener('dragstart', function (e) {
                const row = e.target.closest && e.target.closest('.svc-row');
                if (!row) return;
                dragged = itemOf(row);
                dragged.classList.add('is-dragging');
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', dragged.dataset.id);
            });

            document.addEventListener('dragover', function (e) {
                if (!dragged) return;
                const row = e.target.closest && e.target.closest('.svc-row');
                if (!row) return;
                const target = itemOf(row);
                // Only within the same list: main services among themselves, sub-services under the same parent.
                if (target === dragged || listOf(target) !== listOf(dragged)) return;
                e.preventDefault();
                const rect = target.getBoundingClientRect();
                const after = e.clientY > rect.top + rect.height / 2;
                listOf(target).insertBefore(dragged, after ? target.nextSibling : target);
            });

            document.addEventListener('dragend', function () {
                if (!dragged) return;
                dragged.classList.remove('is-dragging');
                const list = listOf(dragged);
                dragged = null;
                save(list);
            });

            document.addEventListener('click', function (e) {
                const button = e.target.closest('[data-move]');
                if (!button) return;
                const item = itemOf(button.closest('.svc-row'));
                const list = listOf(item);
                const items = itemsIn(list);
                const index = items.indexOf(item);
                const swapWith = button.dataset.move === 'up' ? items[index - 1] : items[index + 1];
                if (!swapWith) return;
                list.insertBefore(item, button.dataset.move === 'up' ? swapWith : swapWith.nextSibling);
                save(list);
            });
        })();
    </script>
@endpush
