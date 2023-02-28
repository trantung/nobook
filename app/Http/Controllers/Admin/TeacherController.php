<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\StoreRequest;
use App\Http\Requests\Teachers\UpdateRequest;
use App\Services\Admin\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @var TeacherService
     */
    protected $teacherService;

    /**
     * TeacherController constructor.
     * @param TeacherService $service
     */
    public function __construct(TeacherService $service)
    {
        $this->teacherService = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->teacherService->index($request);

        if ($request->ajax()) {
            return view('admin.teachers.datatable', $data);
        }

        return view('admin.teachers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $id = $this->teacherService->store($request);

        return redirect()->route('admin.teachers.edit', $id)->with('success', 'Tạo mới thành công!');
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
        $data = $this->teacherService->edit((int) $id);

        return view('admin.teachers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $updated = $this->teacherService->update($request, (int) $id);

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
        return $this->teacherService->destroy($id);
    }

    /**
     * @param Request $request
     * @param int $class
     * @return mixed
     */
    public function updateStatus(Request $request, int $class)
    {
        return $this->teacherService->updateStatus($class);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addSubjects(Request $request, int $id)
    {
        $data = $this->teacherService->addSubjects($request, $id);

        return view('admin.teachers.subjectstable', $data);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function reorderSubjects(Request $request, int $id)
    {
        return $this->teacherService->reorderSubjects($request, $id);
    }

    /**
     * @param int $id
     * @param int $subject
     * @return bool
     */
    public function destroySubject(int $id, int $subject)
    {
        return $this->teacherService->destroySubject($id, $subject);
    }
}
