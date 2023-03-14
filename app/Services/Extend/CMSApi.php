<?php

namespace App\Services\Extend;

use GuzzleHttp\Client;

/**
 * Class CMSApi
 * @package App\Services\Extend
 *
 * @method ResponseInterface get(string|UriInterface $uri, array $options = [], array $headers = [])
 * @method ResponseInterface head(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface put(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface post(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface patch(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface delete(string|UriInterface $uri, array $options = [])
 */
class CMSApi
{
    /**
     * @var Client
     */
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'protocols' => ['http', 'https'],
            'referer' => true,
            'base_uri' => env('CMS_API'),
            'headers' => [
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    /**
     * @param string $token
     * @return \string[][]
     */
    protected function headers(string $token)
    {
        return [
            'headers' => [
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ];
    }

    /**
     * @param array $input
     * @return ResponseInterface
     */
    public function login(array $input)
    {
        return $this->post('api/auth/token', $input);
    }

    /**
     * @param string $token
     * @return ResponseInterface
     */
    public function userInfo(string $token)
    {
        return $this->get('api/auth/users/info', $this->headers($token));
    }

    /**
     * Magic call
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->_client->$name(...$arguments);
    }
}
