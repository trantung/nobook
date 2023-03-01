@extends('admin.layouts.main', ['title' => 'Thêm môn', 'activePage' => 'subjects-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">Quản lý danh sách môn học</a></li>
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
                        <form class="mt-4" name="create" action="{{ route('admin.subjects.store') }}" method="POST">
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
                                        <label>Tên môn học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" required class="form-control input-default">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã môn học</label>
                                        <input type="text" name="code" class="form-control input-default">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-switch-toggle-container">
                                            <label class="custom-switch-toggle">
                                                <input type="checkbox" name="is_public">
                                                <span class="slider"></span>
                                            </label>
                                            <label class="switch-label">Hiển thị</label>
                                        </div>
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
