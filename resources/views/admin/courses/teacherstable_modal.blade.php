<div class="table-responsive">
    <div class="row mr-0 ml-0">
        <table class="table table-striped table-bordered zero-configuration">
            <tbody class="sort">
            @forelse($allTeachers->items() as $teacher)
                <tr
                    class="class-info"
                    data-id="{{ $teacher->id }}"
                    id="{{ $teacher->id }}"
                    data-edit="{{ route('admin.teachers.edit', $teacher->id) }}"
                >
                    <td class="text-center" width="5%">{{ $teacher->id }}</td>
                    <td class="text-center" style="height: 160px;width: 160px;"><img style="max-height: 100%;" src="{{ $teacher->getAvatar() }}"></td>
                    <td class="class-name text-left" style="cursor: pointer;">
                        <h4 class="mb-0">{{ $teacher->name ?? '' }}</h4>
                        <div class="label">{{ $teacher->label }}</div>
                        <div class="description">
                            {!! $teacher->description !!}
                        </div>
                    </td>
                    <td class="text-center" width="10%">
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
                    <td colspan="3">Không có dữ liệu.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="row ml-0 mr-0">
        <div class="col-md-12">
            {{ $allTeachers->links('vendor.pagination.datatable') }}
        </div>
    </div>
</div>
