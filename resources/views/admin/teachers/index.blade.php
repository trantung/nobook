@extends('admin.layouts.main', ['title' => 'Danh sách lớp', 'activePage' => 'teachers-menu-index'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex;justify-content: space-between;" class="mb-4">
                            <h4 class="card-title">Danh sách giáo viên</h4>
                            <a class="btn mb-1 btn-primary add-category" href="{{ route('admin.teachers.create') }}">Thêm mới</a>
                        </div>
                        <div class="row table-filter">
                            <div class="col-sm-12 col-md-6">
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
                            <div class="col-sm-12 col-md-6 text-filter">
                                <label>
                                    Tìm kiếm:
                                    <input type="search" class="form-control form-control-sm filter">
                                </label>
                            </div>
                        </div>
                        <div class="table-data" data-link=""{{ route('admin.teachers.index') }}>
                            @include('admin.teachers.datatable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
        <link href="{{ asset('assets/admin/css/user.css') }}" rel="stylesheet">
    <link src="{{ asset('assets/admin/css/datatable.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/js/teacher.index.js') }}"></script>
@endpush
