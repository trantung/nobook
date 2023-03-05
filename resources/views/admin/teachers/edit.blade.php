@extends('admin.layouts.main', ['title' => 'Chi tiết giáo viên', 'activePage' => 'teachers-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">Quản lý danh sách giáo viên</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Cập nhật</a></li>
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
                        <div class="default-tab">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#info"><h4 class="card-title mb-0">Thông tin cơ bản</h4></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#subjects"><h4 class="card-title mb-0">Môn học</h4></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="info" role="tabpanel">
                                    <form class="mt-4" name="create" action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input hidden name="id" value="{{ $teacher->id }}">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary ml-auto">Cập nhật</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tên giáo viên <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" value="{{ $teacher->name ?? '' }}" required class="form-control input-default">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Danh hiệu giáo viên</label>
                                                    <input type="text" name="label" value="{{ $teacher->label ?? '' }}"  class="form-control input-default">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-switch-toggle-container">
                                                        <label class="custom-switch-toggle">
                                                            <input type="checkbox" name="is_public" @if($teacher->is_public) checked @endif>
                                                            <span class="slider"></span>
                                                        </label>
                                                        <label class="switch-label">Hiển thị</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Ảnh đại diện</label>
                                                    <div class="fileinput fileinput-new d-block" data-provides="fileinput">
                                                        @if ($teacher->avatar)
                                                            <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="{{ $teacher->getAvatar() }}"
                                                                     alt="...">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                        @else
                                                            <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                        @endif
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
                                                    <label>Mô tả</label>
                                                    <textarea name="description" class="form-control input-default ckeditor">{{ $teacher->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="subjects" role="tabpanel">
                                    <div style="text-align: right;" class="row mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6 mini">
                                            <select name="subjects[]" id="select_subjects" multiple>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn mb-1 btn-primary add_subject" href="#" data-href="{{ route('admin.teachers.add_subjects', $teacher->id) }}">Chọn môn học</a>
                                        </div>
                                    </div>
                                    <div class="subject-data table-data" data-order="{{ route('admin.teachers.reorder_subjects', $teacher->id) }}">
                                        @include('admin.teachers.subjectstable')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/admin/css/miniselect2.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/admin/js/teachers.create.js') }}"></script>
    <script src="{{ asset('assets/admin/js/teachers.edit.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ckeditor/ckeditor.js') }}"></script>
@endpush
