<?php

namespace App\Http\Controllers\Api\CMS;

use App\Http\Controllers\Controller;
use App\Libs\Traits\ApiResponse;
use App\Services\Api\CourseService;
use App\Services\Api\CMS\UserService;
use Illuminate\Http\Request;

class CourseCMSController extends Controller
{
    use ApiResponse;

    /**
     * @var CourseService
     */
    protected $courseService;
    // protected $userService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        // $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        // $filter = [
        //     'class_id' => $request->get('class_id'),
        //     'subject_id' => $request->get('subject_id'),
        //     'group_by_class' => $request->get('group_by_class'),
        //     'group_by_subject' => $request->get('group_by_subject'),
        // ];
        // check token by call to Api CMS
        // if (!empty($request->bearerToken())) {
        //     try {
        //         $response = $this->userService->getUserInfo($request);
        //     } catch (\Exception $e) {
        //         dd(11);
        //     }
        // }
        try {
            $data = $this->courseService->list();
            // dd($data);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    public function detail($id)
    {
        $login = false;
        //check token from frontend
        if (!empty($request->bearerToken())) {
            try {
                $response = $this->userService->getUserInfo($request);
            } catch (\Exception $e) {
                $login = true;
            }
        }
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
