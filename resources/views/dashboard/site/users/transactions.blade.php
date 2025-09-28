@extends('dashboard.core.app')
@section('title', __('dashboard.transactions'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.transactions') }}" :breadcrumbs="[['name' => __('dashboard.transactions'), 'route' => 'transactions.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.transactions')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <button class="btn btn-primary btn-wave waves-effect waves-light me-1" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            {{ __('dashboard.Create') }} </button>
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap" id="transactions_table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.type')</th>
                            <th>@lang('dashboard.value')</th>
                            <th>@lang('dashboard.reason')</th>
                            {{-- <th>@lang('dashboard.Operations')</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->transactions as $transaction)
                            <tr id="row-{{ $transaction->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($transaction->type === 'increase')
                                        @lang('dashboard.increase')
                                    @elseif($transaction->type === 'decrease')
                                        @lang('dashboard.decrease')
                                    @endif
                                </td>

                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->reason }}</td>
                                {{-- <td>
                                    <div class="hstack gap-2 fs-15">
                                            <x-buttons.delete-button :route="route('users.deleteTransaction',$transaction->id)" :itemId="$transaction->id" />

                                        </div>
                                </td> --}}
                            </tr>


                            <!-- Add Transaction Modal -->


                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                    </tbody>
                </table>

                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">@lang('dashboard.search')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form method="post" action="{{ route('usres.addTransaction', $user->id) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">@lang('dashboard.type')</label>
                                        <select name="type" id="type" class="form-select" required>
                                            <option value="" desapled>@lang('dashboard.select_transaction_type')</option>
                                            <option value="increase">@lang('dashboard.increase')</option>
                                            <option value="decrease">@lang('dashboard.decrease')</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="searchInput" class="form-label">@lang('dashboard.value')</label>
                                        <input type="text" name="amount" id="searchInput" class="form-control"
                                            placeholder="" value="{{ request('amount') }}" required>
                                    </div>

                                    <!-- Reason -->
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">@lang('dashboard.reason')</label>
                                        <input type="text" name="reason" id="reason" class="form-control">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        @lang('dashboard.close')
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        @lang('dashboard.save')
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $transactions->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>


    </div>
@endsection
@section('js_addons')

@endsection
