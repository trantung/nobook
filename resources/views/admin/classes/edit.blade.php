@extends('admin.layouts.main', ['title' => 'Thêm lớp', 'activePage' => 'classes-menu'])
@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb" style="float: unset !important;">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">Quản lý danh sách lớp</a></li>
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
                        <form class="mt-4" name="create" action="{{ route('admin.classes.update', $class->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input hidden name="id" value="{{ $class->id }}">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary ml-auto">Cập nhật</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên lớp học <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $class->name }}" required class="form-control input-default">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã lớp học</label>
                                        <input type="text" name="code" value="{{ $class->code }}" class="form-control input-default">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên lớp học <span class="text-danger">*</span></label>
                                        <select type="text" name="level" required class="form-control input-default">
                                            @foreach(\App\Models\ClassModel::LEVELS as $key => $value)
                                                <option @if($class->level == $value) selected @endif value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" @if($class->is_public) checked @endif name="is_public">
                                            <label class="custom-control-label" for="customSwitch1">Hiển thị</label>
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
