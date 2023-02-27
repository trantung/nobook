<?php

namespace App\Services\LMS;

use App\Models\CourseLMS;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CourseLMSService
{
    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * @return array
     */
    public function getPaginateList(Request $request)
    {
        $paginate = $request->perpage ?? $this->perPage;
        $query = (new CourseLMS())->newQuery();
        $query->where([
            ['format', 'topics'],
            ['summaryformat', 1],
        ]);

        if ($request->text) {
            $query->where(function (Builder $builder) use ($request) {
                $text = '%'.$request->text.'%';
                $builder->where('fullname', 'like', $text)
                    ->orWhere('id', 'like', $text);
            });
        }

        $courses = $query
            ->orderByDesc('id')
            ->select([
                'id',
                'fullname',
            ])
            ->paginate($paginate);

        return compact('courses');
    }

    /**
     * @param int $id
     * @return CourseLMS|null
     */
    public function findById(int $id): ?CourseLMS
    {
        return (new CourseLMS())->newQuery()->find($id);
    }
}
