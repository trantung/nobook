@extends('admin.layouts.main', ['title' => 'Danh sách lớp', 'activePage' => 'classes-menu-index'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex;justify-content: space-between;" class="mb-4">
                            <h4 class="card-title">Danh sách lớp</h4>
                            <a class="btn mb-1 btn-primary add-category" href="{{ route('admin.classes.create') }}">Thêm mới</a>
                        </div>
                        <div class="table-data" data-order="{{ route('admin.classes.reorder') }}">
                            @include('admin.classes.datatable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
{{--    <link href="{{ asset('assets/admin/css/user.css') }}" rel="stylesheet">--}}
    <link src="{{ asset('assets/admin/css/datatable.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/js/class.index.js') }}"></script>
@endpush
