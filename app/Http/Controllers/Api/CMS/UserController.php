<?php

namespace App\Http\Controllers\Api\CMS;

use App\Http\Controllers\Controller;
use App\Libs\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\Api\CMS\UserService;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $data = $this->userService->login($request);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request)
    {
        try {
            $data = $this->userService->getUserInfo($request);
            $this->response->succeeded()->data($data);
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }

        return $this->ok();
    }

}
