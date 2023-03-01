<div class="table-responsive">
    <div class="row mr-0 ml-0">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
            <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">Avatar</th>
                <th class="text-center">Tên giáo viên</th>
                <th class="text-center">Bộ môn</th>
                <th class="text-center" width="10%">Hiển thị</th>
                <th class="text-center" style="width: 10%">Thao tác</th>
            </tr>
            </thead>
            <tbody class="sort">
            @forelse($teachers as $teacher)
                <tr
                    class="class-info"
                    data-id="{{ $teacher->id }}"
                    id="{{ $teacher->id }}"
                    data-edit="{{ route('admin.teachers.edit', $teacher->id) }}"
                >
                    <td class="handle"
                        style="padding-top: 0 !important;padding-bottom: 0 !important;width: 55px;cursor: pointer;"
                        data-toggle="tooltip"
                        data-placement="left"
                        title="Giữ để sắp xếp"
                    >
                        <i class="icon-list" style="font-size: 25px"></i>
                    </td>
                    <td class="text-center">{{ $teacher->id ?? '' }}</td>
                    <td class="text-center" style="height: 160px;"><img style="max-height: 100%;" src="{{ $teacher->getAvatar() }}"></td>
                    <td class="class-name text-center" style="cursor: pointer;">{{ $teacher->name ?? '' }}</td>
                    <td class="class-name text-center" style="cursor: pointer;">{{ $teacher->subjects->pluck('name')->implode(', ') }}</td>
                    <td class="text-center class-is_public">
                        <i
                            class="@if($teacher->is_public) icon-check text-green @else icon-close text-danger @endif custom-active-icon change-status"
                            data-url="{{ route('admin.teachers.change_status', $teacher->id) }}"
                        ></i>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="mr-3">
                            <i class="custom-active-icon icon-note"></i>
                        </a>
                        <a href="#" data-href="{{ route('admin.courses.destroy_teacher', ['id' => $course->id, 'teacher' => $teacher->id]) }}" class="destroy">
                            <i class="custom-active-icon icon-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="7">Không có dữ liệu.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
