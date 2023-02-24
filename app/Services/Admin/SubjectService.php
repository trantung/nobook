<?php

namespace App\Services\Admin;

use App\Http\Requests\Subjects\StoreRequest;
use App\Http\Requests\Subjects\UpdateRequest;
use App\Libs\Service\BaseService;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SubjectService extends BaseService
{
    /**
     * @var int
     */
    protected $perPage = 10;

    public function index(Request $request)
    {
        $paginate = $request->perpage ?? $this->perPage;
        $query = Subject::query();

        if ($request->text) {
            $query->where(function (Builder $builder) use ($request) {
                $text = '%'.$request->text.'%';
                $builder->where('name', 'like', $text)
                    ->orWhere('code', 'like', $text);
            });
        }

        $subjects = $query
            ->orderByDesc('order')
            ->paginate($paginate);

        return compact('subjects');
    }

    /**
     * @param StoreRequest $request
     * @return int
     */
    public function store(StoreRequest $request)
    {
        /** @var Subject $subject */
        $subject = Subject::query()->create(
            array_merge($this->prepareData($request), [
                'order' => (Subject::query()->max('order') ?? 0) + 1
            ])
        );

        return $subject->id;
    }

    /**
     * @param int $id
     * @return array
     */
    public function edit(int $id)
    {
        /** @var Subject $subject */
        $subject = Subject::query()->findOrFail($id);

        return compact('subject');
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var Subject $subject */
        $subject = Subject::query()->findOrFail($id);

        return $subject->update($this->prepareData($request));
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function reorder(Request $request)
    {
        return $this->reorderData(new Subject(), (array) $request->sort);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        /** @var Subject $record */
        $record = Subject::query()->findOrFail($id);

        return $record->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateStatus(int $id)
    {
        return $this->updateStatusData(new Subject(), $id);
    }

    /**
     * @param StoreRequest|UpdateRequest $request
     * @return array
     */
    protected function prepareData(Request $request): array
    {
        $attributes = $request->all();
        $attributes['is_public'] = $request->is_public ? 1 : 0;

        return $attributes;
    }
}
