@extends('admin.layouts.main', ['title' => 'Cập nhật khóa học', 'activePage' => 'courses-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Quản lý danh sách khóa học</a></li>
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
                        <h3 class="card-title">Thông tin cơ bản</h3>
                        <form class="mt-4" name="create" action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input hidden name="id" value="{{ $course->id }}">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary ml-auto">Cập nhật</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên khóa học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $course->name ?? '' }}" required class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Loại khóa học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="type" required>
                                            @foreach($types as $key => $value)
                                                <option value="{{ $value }}" @if($course->type == $value) selected @endif>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lớp học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="classes[]" id="select_classes" required multiple>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" @if(in_array($class->id, $course->classIds)) selected @endif>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Môn học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="subjects[]" id="select_subjects" required multiple>
                                            @forelse($course->subjects as $subject)
                                                <option selected value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Link video intro</label>
                                        <input type="text" name="intro_link" value="{{ $course->intro_link ?? '' }}" class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Mã khóa học tại LMS Nobook <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="lms_id" id="select_lms_courses" required>
                                            <option selected value="{{ $lmsCourse->id }}">{{ "[$lmsCourse->id] $lmsCourse->fullname" }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình thức học <span class="text-danger">*</span></label>
                                        <select class="form-control input-default" name="method" required>
                                            @foreach($methods as $key => $value)
                                                <option value="{{ $value }}" @if($course->method == $value) selected @endif>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" @if($course->is_public) checked @endif name="is_public">
                                                    <label class="custom-control-label" for="customSwitch1">Hiển thị</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2" @if($course->is_highlight) checked @endif name="is_highlight">
                                                    <label class="custom-control-label" for="customSwitch2">Hiển thị trang chủ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label>
                                        <textarea class="form-control input-default" placeholder="Nhập vào mô tả ngắn" name="description">{{ $course->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ảnh đại diện desktop</label>
                                                <div class="fileinput fileinput-new d-block" data-provides="fileinput">
                                                    @if ($course->desktop_avatar)
                                                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="{{ $course->getDesktopAvatar() }}"
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
                                                    @if ($course->mobile_avatar)
                                                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="{{ $course->getMobileAvatar() }}"
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
                                        <input type="text" name="slug" value="{{ $course->slug ?? '' }}" class="form-control input-default">
                                    </div>
                                    <div class="form-group">
                                        <label>Khóa học bao gồm</label>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-social-youtube inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="video_include" value="{{ $course->getIncludeContent()['video_include'] ?? '' }}" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-docs inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="article_include" value="{{ $course->getIncludeContent()['article_include'] ?? '' }}" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center mb-3">
                                                <i class="icon-screen-smartphone inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="access_include" value="{{ $course->getIncludeContent()['access_include'] ?? '' }}" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <i class="icon-trophy inclulde-icon"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="certificate_include" value="{{ $course->getIncludeContent()['certificate_include'] ?? '' }}" class="form-control input-default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô tả chi tiết khóa học</label>
                                        <textarea name="detail" placeholder="Nhập vào mô tả chi tiết khóa học" class="form-control input-default ckeditor">{{ $course->detail ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Kết quả nhận được</label>
                                        <textarea name="result_content" placeholder="Nhập nội dung kết quả nhận được" class="form-control input-default ckeditor">{{ $course->result_content ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Đối tượng học</label>
                                        <textarea name="object_content" placeholder="Nhập nội dung đối tượng học" class="form-control input-default ckeditor">{{ $course->object_content ?? '' }}</textarea>
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
