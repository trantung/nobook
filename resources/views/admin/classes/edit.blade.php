@extends('admin.layouts.main', ['title' => 'Chi tiết lớp', 'activePage' => 'classes-menu'])
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
                                        <label>Cấp học <span class="text-danger">*</span></label>
                                        <select name="level" required class="form-control input-default">
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
                                        <div class="custom-switch-toggle-container">
                                            <label class="custom-switch-toggle">
                                                <input type="checkbox" name="is_public" @if($class->is_public) checked @endif>
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
@push('js')
    @push('js')
        <script>
            $(document).ready(function () {
                $('select[name=level]').select2({
                    minimumResultsForSearch: -1
                });
            });
        </script>
    @endpush
@endpush
