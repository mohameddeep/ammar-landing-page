@extends('dashboard.core.app')
@section('title', 'إضافة اشتراك')
@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('content')
<nav aria-label="breadcrumb" class="px-2 py-1">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">الرئسية</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route("courses.index") }}">الدورات</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{route('packages.index',$course->id)}}">الباقات</a>
        </li>
        <li class="breadcrumb-item">
            إضافة اشتراك
        </li>
    </ol>
</nav>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('packages.store',$course->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">اضافه باقة</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">اسم الباقة</label>
                                        <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" placeholder="أدخل اسم الباقة">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="duration"> نوع الباقة</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value=""disabled>اختر نوع الباقة</option>
                                            @foreach (\App\Http\Enums\DurationTypeEnum::cases() as $type)
                                            <option
                                                value="{{ $type->value }}"
                                            >
                                                {{ $type->t() }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">سعر الباقة</label>
                                        <input name="price" type="number" class="form-control" id="price" value="{{ old('price') }}" placeholder="أدخل سعر الباقة">
                                    </div>
                                </div>
                                <div class="card-header bg-light border-bottom">
                                    <h5 class="fw-bold text-primary mb-0">إضافة مميزات</h5>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="answersTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>الوصف</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        {{-- <input type="text" name="features[]" class="form-control" placeholder="ادخل الوصف"> --}}
                                                        <textarea name="features[]"  class="form-control" id="" cols="15" rows="3"></textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm remove-answer">حذف</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-info add-answer">إضافة</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                theme: 'bootstrap4',
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
     <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
            // Function to update row numbers after adding/removing rows
            function updateRowNumbers() {
                $('#answersTable tbody tr').each(function (index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
            // Append a new answer row when clicking the "إضافة" button
            $('.add-answer').on('click', function () {
                let rowIndex = $('#answersTable tbody tr').length + 1;
                let newRow = `
                    <tr>
                        <td>${rowIndex}</td>
                        <td>
                                                        <textarea name="features[]"  class="form-control" id="" cols="15" rows="3"></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-answer">حذف</button>
                        </td>
                    </tr>`;
                $('#answersTable tbody').append(newRow);
            });
            // Remove an answer row and update row numbers
            $(document).on('click', '.remove-answer', function () {
                $(this).closest('tr').remove();
                updateRowNumbers();
            });
        });
    </script>
@endsection