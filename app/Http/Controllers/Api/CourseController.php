<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\Traits\ApiResponse;
use App\Services\Api\CourseService;
use App\Services\Api\ClassService;
use App\Services\Api\SubjectService;
use App\Services\Api\CMS\UserService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiResponse;

    /**
     * @var CourseService
     */
    protected $courseService;
    protected $userService;
    protected $classService;
    protected $subjectService;

    public function __construct(CourseService $courseService, UserService $userService, ClassService $classService, SubjectService $subjectService)
    {
        $this->courseService = $courseService;
        $this->userService = $userService;
        $this->classService = $classService;
        $this->subjectService = $subjectService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeList(Request $request)
    {
        try {
            $data = $this->courseService->homeList($request);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id, Request $request)
    {
        try {
            $data = $this->courseService->detail($id);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    public function classList(Request $request)
    {
        try {
            $data = $this->classService->classSubjectList($request);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    public function subjectList(Request $request)
    {
        try {
            $data = $this->subjectService->subjectList($request);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();       
    }
}
