<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\StoreRequest;
use App\Http\Requests\Subjects\UpdateRequest;
use App\Services\Admin\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * @var SubjectService
     */
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|array
     */
    public function index(Request $request)
    {
        $data = $this->subjectService->index($request);

        if ($request->ajax()) {
            if ($request->is_select2) {
                return $data;
            }

            return view('admin.subjects.datatable', $data);
        }

        return view('admin.subjects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $id = $this->subjectService->store($request);

        return redirect()->route(route_with_add_action('admin.subjects.edit'), $id)->with('success', 'Tạo mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->subjectService->edit((int) $id);

        return view('admin.subjects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $updated = $this->subjectService->update($request, (int) $id);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->subjectService->destroy($id);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function reorder(Request $request)
    {
        return $this->subjectService->reorder($request);
    }

    /**
     * @param Request $request
     * @param int $class
     * @return bool
     */
    public function updateStatus(Request $request, int $class)
    {
        return $this->subjectService->updateStatus($class);
    }
}
