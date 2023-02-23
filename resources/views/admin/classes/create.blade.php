@extends('admin.layouts.main', ['title' => 'Thêm lớp', 'activePage' => 'classes-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">Quản lý danh sách lớp</a></li>
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
                        <form class="mt-4" name="create" action="{{ route('admin.classes.store') }}" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên lớp học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" required class="form-control input-default">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã lớp học</label>
                                        <input type="text" name="code" class="form-control input-default">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên lớp học <span class="text-danger">*</span></label>
                                        <select type="text" name="name" required class="form-control input-default">
                                            @foreach(\App\Models\ClassModel::LEVELS as $key => $value)
                                                <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên lớp học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" required class="form-control input-default">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã lớp học</label>
                                        <input type="text" name="code" class="form-control input-default">
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
