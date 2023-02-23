<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
