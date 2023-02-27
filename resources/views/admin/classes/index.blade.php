@extends('admin.layouts.main', ['title' => 'Danh sách lớp', 'activePage' => 'classes-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Quản lý danh sách lớp</a></li>
            </ol>
        </div>
    </div>
@endsection
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
