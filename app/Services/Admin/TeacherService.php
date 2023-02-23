<?php

namespace App\Services\Admin;

use App\Libs\Service\BaseService;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TeacherService extends BaseService
{
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
            ->orderByDesc('created_at')
            ->paginate($paginate);

        return compact('teachers');
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
}
