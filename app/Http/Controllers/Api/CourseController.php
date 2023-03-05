<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\Traits\ApiResponse;
use App\Services\Api\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiResponse;

    /**
     * @var CourseService
     */
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeList(Request $request)
    {
        try {
            $data = $this->courseService->homeList();
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    public function detail($id)
    {
        try {
            $data = $this->courseService->detail($id);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            dd($exception);
            $this->handleException($exception);
        }

        return $this->ok();
    }
}
