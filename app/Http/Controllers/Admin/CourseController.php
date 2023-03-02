<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreRequest;
use App\Http\Requests\Courses\UpdateRequest;
use App\Services\Admin\CourseService;
use App\Services\Admin\TeacherService;
use App\Services\LMS\CourseLMSService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    protected $courseService;

    /**
     * @var CourseLMSService
     */
    protected $courseLMSService;

    /**
     * CourseController constructor.
     * @param CourseService $courseService
     * @param CourseLMSService $courseLMSService
     */
    public function __construct(CourseService $courseService, CourseLMSService $courseLMSService)
    {
        $this->courseService = $courseService;
        $this->courseLMSService = $courseLMSService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $courses = $this->courseService->getCourses($request);

            return view('admin.courses.datatable', compact('courses'));
        }
        $data = $this->courseService->index($request);

        return view('admin.courses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->courseService->create();

        return view('admin.courses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $id = $this->courseService->store($request);

        return redirect()->route(route_with_add_action('admin.courses.edit'), $id)->with('success', 'Tạo mới thành công!');
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
        $data = $this->courseService->edit($id);

        return view('admin.courses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $updated = $this->courseService->update($request, $id);

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
        return $this->courseService->destroy($id);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function lmsList(Request $request)
    {
        $data = $this->courseLMSService->getPaginateList($request);

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @param int $course
     * @return false
     */
    public function updateStatus(Request $request, int $course)
    {
        return $this->courseService->updateStatus($request, $course);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTeachers(Request $request, int $id)
    {
        $data = $this->courseService->addTeachers($request, $id);

        return view('admin.courses.teacherstable', $data);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function reorderTeachers(Request $request, int $id)
    {
        return $this->courseService->reorderTeachers($request, $id);
    }

    /**
     * @param int $id
     * @param int $teacher
     * @return bool
     */
    public function destroyTeacher(int $id, int $teacher)
    {
        return $this->courseService->destroyTeacher($id, $teacher);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTeachersPaginate(Request $request)
    {
        $allTeachers = (new TeacherService())->index($request)['teachers'];

        return view('admin.courses.teacherstable_modal', compact('allTeachers'));
    }
}
