@extends('dashboard.core.app')
@section('title', __('dashboard.notifications'))

@section('content')
<div class="container-fluid px-5 py-3">
    <!-- ✅ Page Header -->
    <x-breadcrumb.breadcrumb
        title="{{ __('dashboard.notifications') }}"
        :breadcrumbs="[['name' => __('dashboard.notifications'), 'route' => 'notifications.index']]" 
    />

    <!-- ✅ Notifications Card -->
    <x-cards.page-card>
        <x-slot name="header">
            <div class="card-title">
                @lang('dashboard.notifications')
            </div>
        </x-slot>

        <div class="table-responsive">
            <table class="table text-nowrap align-middle">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>@lang('dashboard.title')</th>
                        <th>@lang('dashboard.message')</th>
                        <th>@lang('dashboard.status')</th>
                        <th>@lang('dashboard.date')</th>
                        <th>@lang('dashboard.Operations')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notification)
                        @php
                            $data = $notification->data ?? [];
                            $isRead = $notification->read_at ? true : false;
                        @endphp

                        <tr id="row-{{ $notification->id }}" class="{{ $isRead ? '' : 'table-light' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['title'] ?? '-' }}</td>
                            <td>{{ Str::limit($data['body'] ?? '-', 50, '...') }}</td>
                            <td>
                                @if($isRead)
                                    <span class="badge bg-success">@lang('dashboard.read')</span>
                                @else
                                    <span class="badge bg-warning">@lang('dashboard.unread')</span>
                                @endif
                            </td>
                            <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="hstack gap-2 fs-15">
                                    @if(isset($data['complaint_id']))
                                        <a href="{{ route('complaints.show', ['id' => $data['complaint_id'], 'notification_id' => $notification->id]) }}"
                                            class="btn btn-sm btn-icon btn-info" 
                                            title="@lang('dashboard.view')">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    @endif

                                    @if(!$isRead)
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-success mark-read-btn"
                                            data-id="{{ $notification->id }}"
                                            title="@lang('dashboard.mark_as_read')">
                                            <i class="ri-check-line"></i>
                                        </button>
                                    @endif

                                    <x-buttons.delete-button  
                                        :route="route('notifications.destroy', $notification->id)"  
                                        :itemId="$notification->id"  
                                    /> 
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-slot name="footer">
            <div class="d-flex justify-content-end align-items-center">
                {{ $notifications->links() }}
            </div>
        </x-slot>
    </x-cards.page-card>
</div>
@endsection

@push('scripts')
<script>
    // ✅ Mark Notification as Read
    $(document).on('click', '.mark-read-btn', function () {
        let id = $(this).data('id');
        let url = "{{ route('notifications.markAsRead', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function (res) {
                location.reload();
            },
            error: function (err) {
                alert('Error marking notification as read');
            }
        });
    });
</script>
@endpush
