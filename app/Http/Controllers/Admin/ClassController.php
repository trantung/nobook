<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ClassService;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * @var ClassService
     */
    protected $classService;

    /**
     * ClassController constructor.
     * @param ClassService $classService
     */
    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->classService->index($request);

        return view('admin.classes.index', $data);
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
     * @param  int  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy($class)
    {
        return $this->classService->destroy($class);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function reorder(Request $request)
    {
        return $this->classService->reorder($request);
    }

    public function updateStatus(Request $request, int $class)
    {
        return $this->classService->updateStatus($class);
    }
}
