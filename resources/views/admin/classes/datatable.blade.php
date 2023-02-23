<div class="table-responsive">
    <div class="row mr-0 ml-0">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
            <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">Tên lớp học</th>
                <th class="text-center">Mã lớp học</th>
                <th class="text-center">Cấp học</th>
                <th class="text-center">Trạng thái hiển thị</th>
                <th class="text-center" style="width: 10%">Thao tác</th>
            </tr>
            </thead>
            <tbody class="sort">
                @forelse($classes as $class)
                    <tr
                        class="class-info"
                        data-id="{{ $class->id }}"
                        id="{{ $class->id }}"
                        data-edit="{{ route('admin.classes.edit', ['class' => $class->id]) }}"
                    >
                        <td class="handle"
                            style="padding-top: 0 !important;padding-bottom: 0 !important;width: 55px;cursor: pointer;"
                            data-toggle="tooltip"
                            data-placement="left"
                            title="Giữ để sắp xếp"
                        >
                            <i class="icon-list" style="font-size: 25px"></i>
                        </td>
                        <td class="text-center">{{ $class->id ?? '' }}</td>
                        <td class="class-name text-center" style="cursor: pointer;">{{ $class->name ?? '' }}</td>
                        <td class="class-name text-center" style="cursor: pointer;">{{ $class->code ?? '' }}</td>
                        <td class="text-center class-level">{{ $class->getDisplayLevel() }}</td>
                        <td class="text-center class-is_public">
                            <i
                                class="@if($class->is_public) icon-check @else icon-close @endif custom-active-icon change-status"
                                data-url="{{ route('admin.classes.change_status', ['class' => $class->id]) }}"
                            ></i>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.classes.edit', $class->id) }}" class="mr-3">
                                <i class="custom-active-icon icon-note"></i>
                            </a>
                            <a href="#" data-href="{{ route('admin.classes.destroy', $class->id) }}" class="destroy">
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
