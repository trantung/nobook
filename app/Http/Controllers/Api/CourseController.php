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
        $filter = [
            'class_id' => $request->get('class_id'),
            'subject_id' => $request->get('subject_id'),
            'group_by_class' => $request->get('group_by_class'),
            'group_by_subject' => $request->get('group_by_subject'),
        ];
        //check token by call to Api CMS
        // $token = $request->get('token');
        // if (!empty($token)) {
            
        // }

        try {
            $data = $this->courseService->homeList($filter);
            // dd($data);
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
