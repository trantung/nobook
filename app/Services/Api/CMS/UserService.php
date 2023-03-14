<?php

namespace App\Services\Api\CMS;

use App\Libs\Facades\CMSApi;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $response = CMSApi::login($request->only(['username', 'password']));

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getUserInfo(Request $request)
    {
        $response = CMSApi::userInfo($request->bearerToken());

        return json_decode($response->getBody()->getContents());
    }
}
