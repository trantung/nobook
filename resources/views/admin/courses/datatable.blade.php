<div class="table-responsive">
    <div class="row mr-0 ml-0">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
            <tr>
                <th class="text-center" width="5%">ID</th>
                <th class="text-center" width="15%">Avatar</th>
                <th class="text-center">Tên khóa học</th>
                <th class="text-center" width="10%">Hiển thị</th>
                <th class="text-center" width="10%">Hiển thị ở trang chủ</th>
                <th class="text-center" style="width: 10%">Thao tác</th>
            </tr>
            </thead>
            <tbody class="sort">
            @forelse($courses as $course)
                <tr
                    class="class-info"
                    data-id="{{ $course->id }}"
                    id="{{ $course->id }}"
                    data-edit="{{ route('admin.courses.edit', $course->id) }}"
                >
                    <td class="text-center">{{ $course->id ?? '' }}</td>
                    <td class="class-name text-center" style="cursor: pointer;"><img style="height: 30px;max-width: 30px;" src="{{ $course->getDesktopAvatar() }}"></td>
                    <td class="class-name text-center" style="cursor: pointer;">{{ $course->name ?? '' }}</td>
                    <td class="text-center class-is_public">
                        <i
                            class="@if($course->is_public) icon-check text-green @else icon-close text-danger @endif custom-active-icon change-status"
                            data-column="is_public"
                            data-url="{{ route('admin.courses.change_status', $course->id) }}"
                        ></i>
                    </td>
                    <td class="text-center class-is_public">
                        <i
                            class="@if($course->is_highlight) icon-check text-green @else icon-close text-danger @endif custom-active-icon change-status"
                            data-column="is_highlight"
                            data-url="{{ route('admin.courses.change_status', $course->id) }}"
                        ></i>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="mr-3">
                            <i class="custom-active-icon icon-note"></i>
                        </a>
                        <a href="#" data-href="{{ route('admin.courses.destroy', $course->id) }}" class="destroy">
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
    {{ $courses->links('vendor.pagination.datatable') }}
</div>
