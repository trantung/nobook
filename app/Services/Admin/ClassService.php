<?php

namespace App\Services\Admin;

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
}
