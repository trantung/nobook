<?php

namespace App\Libs\Facades;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Facade;

/**
 * Class CMSApi
 * @package App\Libs\Facades
 *
 * @method static Response login(array $data)
 * @method static Response userInfo(string $token)
 */
class CMSApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cms.service';
    }
}
