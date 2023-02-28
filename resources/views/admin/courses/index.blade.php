@extends('admin.layouts.main', ['title' => 'Danh sách khóa học', 'activePage' => 'courses-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Quản lý danh sách khóa học</a></li>
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
                            <h4 class="card-title">Danh sách khóa học</h4>
                            <a class="btn mb-1 btn-primary add-category" href="{{ route('admin.courses.create') }}">Thêm mới</a>
                        </div>
                        <div class="row table-filter">
                            <div class="col-sm-12 col-md-3">
                                <label>
                                    Hiển thị
                                    <select class="form-control form-control-sm perpage">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    bản ghi
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-4" style="align-self: center">
                                <label style="width: 100%">
                                    <select class="" id="select_subjects" multiple>
                                    </select>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-2 " style="align-self: center">
                                <label style="width: 100%">
                                    <select class="" id="select_method">
                                        <option value selected>Hình thức học</option>
                                        @foreach($methods as $key => $method)
                                            <option value="{{ $method }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-3 text-filter">
                                <label>
                                    Tìm kiếm:
                                    <input type="search" class="form-control form-control-sm filter">
                                </label>
                            </div>
                        </div>
                        <div class="table-data" data-link="{{ route('admin.courses.index') }}">
                            @include('admin.courses.datatable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('assets/admin/css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/datatable.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/miniselect2.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/js/courses.index.js') }}"></script>
@endpush
