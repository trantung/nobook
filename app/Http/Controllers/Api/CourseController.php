<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\Traits\ApiResponse;
use App\Services\Api\CourseService;
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

    public function __construct(CourseService $courseService, UserService $userService)
    {
        $this->courseService = $courseService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeList(Request $request)
    {
        
        // check token by call to Api CMS
        if (!empty($request->bearerToken())) {
            try {
                $response = $this->userService->getUserInfo($request);
                $login = true;
            } catch (\Exception $e) {
                $login = false;
            }
        }
        $filter = [
            'class_id' => $request->get('class_id'),
            'subject_id' => $request->get('subject_id'),
            'group_by_class' => $request->get('group_by_class'),
            'group_by_subject' => $request->get('group_by_subject'),
            'login' => $login
        ];
        try {
            $data = $this->courseService->homeList($filter);
            // dd($data);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    public function detail($id,Request $request)
    {
        //check token from frontend
        $login = false;
        if (!empty($request->bearerToken())) {
            try {
                $response = $this->userService->getUserInfo($request);
                $login = true;
            } catch (\Exception $e) {

            }
        }
        try {
            $data = $this->courseService->detail($id, $login);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            dd($exception);
            $this->handleException($exception);
        }

        return $this->ok();
    }

}
