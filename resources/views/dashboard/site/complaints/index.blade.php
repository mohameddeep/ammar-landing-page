@extends('dashboard.core.app')
@section('title', __('dashboard.complaints'))

@section('content')
<div class="container-fluid px-5 py-3">
    <!-- Page Header -->
    <x-breadcrumb.breadcrumb 
        title="{{ __('dashboard.complaints') }}" 
        :breadcrumbs="[['name' => __('dashboard.complaints'), 'route' => 'complaints.index']]" 
    />
    <!-- Page Header Close -->

    <x-cards.page-card>
        <x-slot name="header">
            <div class="card-title">
                @lang('dashboard.complaints')
            </div>
        </x-slot>

        <div class="table-responsive">
            <table class="table text-nowrap align-middle">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>@lang('dashboard.Name')</th>
                        <th>@lang('dashboard.phone')</th>
                        <th>@lang('dashboard.complaint')</th>
                        <th>@lang('dashboard.response')</th>
                        <th>@lang('dashboard.Operations')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr id="row-{{ $complaint->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $complaint->name }}</td>
                            <td>{{ $complaint->phone }}</td>
                            <td>{{ $complaint->complaint }}</td>

                            {{-- ✅ الرد --}}
                            <td class="response-text">
                                @if($complaint->response)
                                    <span class="short-response">{{ Str::limit($complaint->response, 50, '...') }}</span>
                                    <button  
                                        type="button"  
                                        class="btn btn-sm btn-link p-0 text-primary show-full-response"  
                                        data-response="{{ $complaint->response }}"
                                    >
                                        @lang('dashboard.show_more')
                                    </button>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- ✅ العمليات --}}
                            <td>
                                <div class="hstack gap-2 fs-15">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-icon btn-primary respond-btn"
                                        data-id="{{ $complaint->id }}"
                                        data-response="{{ $complaint->response ?? '' }}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="@lang('dashboard.respond')"
                                    >
                                        <i class="ri-pencil-line"></i>
                                    </button>

                                    <x-buttons.delete-button 
                                        :route="route('complaints.destroy', $complaint->id)" 
                                        :itemId="$complaint->id" 
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
                {{ $complaints->links() }}
            </div>
        </x-slot>
    </x-cards.page-card>
</div>

<!-- ✅ Modal: Respond to Complaint -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="responseForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">@lang('dashboard.respond_to_complaint')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('dashboard.close')"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">@lang('dashboard.response')</label>
                        <textarea name="response" class="form-control" id="response_text" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('dashboard.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ✅ Modal: Show Full Response -->
<div class="modal fade" id="showResponseModal" tabindex="-1" aria-labelledby="showResponseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showResponseModalLabel">@lang('dashboard.response')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('dashboard.close')"></button>
            </div>
            <div class="modal-body">
                <p id="full_response_text" class="mb-0"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // فتح مودال الرد للتعديل
    $(document).on('click', '.respond-btn', function() {
        const id = $(this).data('id');
        const response = $(this).data('response');
        const action = "{{ route('complaints.respond', ':id') }}".replace(':id', id);

        $('#responseForm').attr('action', action);
        $('#response_text').val(response);
        $('#responseModal').modal('show');
    });

    // عرض الرد الكامل
    $(document).on('click', '.show-full-response', function () {
        const response = $(this).data('response');
        $('#full_response_text').text(response);
        $('#showResponseModal').modal('show');
    });
</script>
@endpush
