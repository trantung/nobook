<?php

namespace App\Services\Admin;

use App\Http\Requests\Teachers\StoreRequest;
use App\Http\Requests\Teachers\UpdateRequest;
use App\Libs\Service\BaseService;
use App\Libs\Traits\HandleUpload;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TeacherService extends BaseService
{
    use HandleUpload;

    /**
     * @var int
     */
    protected $perPage = 10;

    public function index(Request $request)
    {
        $paginate = $request->perpage ?? $this->perPage;
        $query = Teacher::query();

        if ($request->text) {
            $query->where(function (Builder $builder) use ($request) {
                $text = '%'.$request->text.'%';
                $builder->where('name', 'like', $text)
                    ->orWhere('label', 'like', $text);
            });
        }

        $teachers = $query
            ->orderByDesc('id')
            ->paginate($paginate);

        return compact('teachers');
    }

    /**
     * @param StoreRequest $request
     * @return int
     */
    public function store(StoreRequest $request)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->create($this->prepareData($request));

        return $teacher->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);

        return compact('teacher');
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var Teacher $teacher */
        $teacher = Teacher::query()->findOrFail($id);

        return $teacher->update($this->prepareData($request));
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /** @var Teacher $record */
        $record = Teacher::query()->findOrFail($id);
        $this->removeImage(storage_path('app/public/'.Teacher::AVATAR_DIR).'/'.$record->avatar);

        return $record->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateStatus(int $id)
    {
        return $this->updateStatusData(new Teacher(), $id);
    }

    /**
     * @param StoreRequest|UpdateRequest $request
     * @return array
     */
    protected function prepareData(Request $request): array
    {
        $attributes = $request->all();
        if ($request->file('avatar')) {
            $attributes['avatar'] = $this->uploadImage($request->file('avatar'), storage_path('app/public/'.Teacher::AVATAR_DIR));
        }
        $attributes['is_public'] = $request->is_public ? 1 : 0;

        return $attributes;
    }
}
