<div class="table-responsive">
    <div class="row mr-0 ml-0">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên giáo viên</th>
                <th class="text-center">Danh hiệu</th>
                <th class="text-center">Trạng thái hiển thị</th>
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
                    <td class="text-center">{{ $teacher->id ?? '' }}</td>
                    <td class="class-name text-center" style="cursor: pointer;">{{ $teacher->name ?? '' }}</td>
                    <td class="class-name text-center" style="cursor: pointer;">{{ $teacher->label ?? '' }}</td>
                    <td class="text-center class-is_public">
                        <i
                            class="@if($teacher->is_public) icon-check @else icon-close @endif custom-active-icon change-status"
                            data-url="{{ route('admin.teachers.change_status', $teacher->id) }}"
                        ></i>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="mr-3">
                            <i class="custom-active-icon icon-note"></i>
                        </a>
                        <a href="#" data-href="{{ route('admin.teachers.destroy', $teacher->id) }}" class="destroy">
                            <i class="custom-active-icon icon-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="5">Không có dữ liệu.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $teachers->links('vendor.pagination.datatable') }}
</div>
