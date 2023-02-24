@extends('admin.layouts.main', ['title' => 'Thêm giáo viên', 'activePage' => 'teachers-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">Quản lý danh sách giáo viên</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm mới</a></li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Thông tin cơ bản</h3>
                        <form class="mt-4" name="create" action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary ml-auto">Tạo mới</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên giáo viên <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') ?? '' }}" required class="form-control input-default">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Danh hiệu giáo viên</label>
                                        <input type="text" name="label" value="{{ old('label') ?? '' }}"  class="form-control input-default">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked name="is_public">
                                            <label class="custom-control-label" for="customSwitch1">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ảnh đại diện</label>
                                        <div class="fileinput fileinput-new d-block" data-provides="fileinput">
                                            <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-outline-secondary btn-file border-0 p-0 rounded">
                                                    <span class="fileinput-new btn btn-outline-secondary btn-sm">Chọn ảnh</span>
                                                    <span
                                                        class="fileinput-exists btn btn-outline-secondary btn-sm">Thay đổi</span>
                                                    <input type="file" name="avatar" accept="image/jpeg,image/png" class="">
                                                </span>
                                                <a href="#" class="btn btn-outline-secondary btn-sm fileinput-exists rounded" data-dismiss="fileinput">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô tả <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control input-default ckeditor"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush