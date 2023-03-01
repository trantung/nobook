@extends('admin.layouts.main', ['title' => 'Thêm khóa học', 'activePage' => 'courses-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Quản lý danh sách khóa học</a></li>
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
                        <form class="mt-4" name="create" action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <div class="btn-group mb-1">
                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"></button>
                                        <div class="dropdown-menu save-dropdown-menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(85px, 37px, 0px);">
                                            <a class="dropdown-item add save-item" href="#"><span>+</span> Lưu + thêm mới</a>
                                            <a class="dropdown-item list save-item" href="#"><i class="icon-list"></i>Lưu + về danh sách</a>
                                        </div>
                                    </div>
                                    <input hidden name="add_action" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên khóa học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') ?? '' }}" required class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Loại khóa học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="type" required>
                                            @foreach($types as $key => $value)
                                                <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lớp học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="classes[]" id="select_classes" required multiple>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Môn học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="subjects[]" id="select_subjects" required multiple>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giáo viên</label>
                                        <select class="form-control input-default" name="teachers[]" id="select_teachers" multiple>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Link video intro</label>
                                        <input type="text" name="intro_link" value="{{ old('intro_link') ?? '' }}" class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Mã khóa học tại LMS Nobook <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="lms_id" id="select_lms_courses" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình thức học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="method" required>
                                            @foreach($methods as $key => $value)
                                                <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
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
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2" checked name="is_highlight">
                                                    <label class="custom-control-label" for="customSwitch2">Hiển thị trang chủ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label>
                                        <textarea class="form-control input-default" placeholder="Nhập vào mô tả ngắn" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ảnh đại diện desktop</label>
                                                <div class="fileinput fileinput-new d-block" data-provides="fileinput">
                                                    <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                <span class="btn btn-outline-secondary btn-file border-0 p-0 rounded">
                                                    <span class="fileinput-new btn btn-outline-secondary btn-sm">Chọn ảnh</span>
                                                    <span
                                                        class="fileinput-exists btn btn-outline-secondary btn-sm">Thay đổi</span>
                                                    <input type="file" name="desktop_avatar" accept="image/jpeg,image/png" class="">
                                                </span>
                                                        <a href="#" class="btn btn-outline-secondary btn-sm fileinput-exists rounded" data-dismiss="fileinput">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ảnh đại diện mobile</label>
                                                <div class="fileinput fileinput-new d-block" data-provides="fileinput">
                                                    <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                <span class="btn btn-outline-secondary btn-file border-0 p-0 rounded">
                                                    <span class="fileinput-new btn btn-outline-secondary btn-sm">Chọn ảnh</span>
                                                    <span
                                                        class="fileinput-exists btn btn-outline-secondary btn-sm">Thay đổi</span>
                                                    <input type="file" name="mobile_avatar" accept="image/jpeg,image/png" class="">
                                                </span>
                                                        <a href="#" class="btn btn-outline-secondary btn-sm fileinput-exists rounded" data-dismiss="fileinput">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" name="slug" value="{{ old('slug') ?? '' }}" class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Khóa học bao gồm</label>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-social-youtube inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="video_include" value="" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-docs inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="article_include" value="" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-screen-smartphone inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="access_include" value="" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <i class="icon-trophy inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="certificate_include" value="" class="form-control input-default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô tả chi tiết khóa học</label>
                                        <textarea name="detail" placeholder="Nhập vào mô tả chi tiết khóa học" class="form-control input-default ckeditor"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Kết quả nhận được</label>
                                        <textarea name="result_content" placeholder="Nhập nội dung kết quả nhận được" class="form-control input-default ckeditor"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Đối tượng học</label>
                                        <textarea name="object_content" placeholder="Nhập nội dung đối tượng học" class="form-control input-default ckeditor"></textarea>
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
@push('css')
    <style>
        .inclulde-icon {
            font-size: 30px;
            line-height: 40px;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('assets/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/js/courses.create.js') }}"></script>
@endpush
