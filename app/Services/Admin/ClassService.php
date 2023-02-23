<?php

namespace App\Services\Admin;

use App\Http\Requests\Classes\StoreRequest;
use App\Http\Requests\Classes\UpdateRequest;
use App\Libs\Service\BaseService;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassService extends BaseService
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $classes = ClassModel::query()
            ->orderByDesc('order')
            ->get();

        return compact('classes');
    }

    /**
     * @param StoreRequest $request
     * @return int
     */
    public function store(StoreRequest $request)
    {
        /** @var ClassModel $class */
        $class = ClassModel::query()->create($this->prepareData($request->all()));

        return $class->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public function edit(int $id)
    {
        /** @var ClassModel $class */
        $class = ClassModel::query()->findOrFail($id);

        return compact('class');
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var ClassModel $class */
        $class = ClassModel::query()->findOrFail($id);

        return $class->update($this->prepareData($request->all()));
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function reorder(Request $request)
    {
        return $this->reorderData(new ClassModel(), (array) $request->sort);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateStatus(int $id)
    {
        return $this->updateStatusData(new ClassModel(), $id);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /** @var ClassModel $record */
        $record = ClassModel::query()->findOrFail($id);

        return $record->delete();
    }

    /**
     * @param array $attributes
     * @return array
     */
    protected function prepareData(array $attributes): array
    {
        $attributes['is_public'] = isset($attributes['is_public']) ? 1 : 0;

        return $attributes;
    }
}
