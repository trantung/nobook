<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\StoreRequest;
use App\Http\Requests\Classes\UpdateRequest;
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
        return view('admin.classes.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $id = $this->classService->store($request);

        return redirect()->route('admin.classes.edit', $id)->with('success', 'Tạo mới thành công!');
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
        $data = $this->classService->edit((int) $id);

        return view('admin.classes.edit', $data);
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
        $updated = $this->classService->update($request, $id);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $class
     * @return boolean
     * @throws \Exception
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

    /**
     * @param Request $request
     * @param int $class
     * @return bool
     */
    public function updateStatus(Request $request, int $class)
    {
        return $this->classService->updateStatus($class);
    }
}
