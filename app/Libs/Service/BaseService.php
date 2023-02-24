<?php

namespace App\Libs\Service;

use App\Models\BaseModel;

abstract class BaseService
{
    /**
     * @param BaseModel $model
     * @param array $ids
     * @return bool
     */
    public function reorderData(BaseModel $model, array $ids)
    {
        $orderColumn = $model->orderColumn;
        $orders = $model::query()
            ->whereIn($model->getPrimaryKey(), $ids)
            ->orderByDesc($orderColumn)
            ->pluck($orderColumn)
            ->toArray();

        foreach ($orders as $key => $value) {
            $model::query()
                ->where($model->getPrimaryKey(), $ids[$key])
                ->update([$orderColumn => $value]);
        }

        return true;
    }

    /**
     * @param BaseModel $model
     * @param int $id
     * @param string $column
     * @return bool
     */
    public function updateStatusData(BaseModel $model, int $id, string $column = 'is_public')
    {
        /** @var BaseModel $record */
        $record = $model::query()->findOrFail($id);

        return $record->update([$column => $record->is_public ? 0 : 1]);
    }

}
