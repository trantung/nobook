<?php

namespace App\Libs\Traits;
use App\Libs\Data\Response as JsonRespone;
use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ApiResponse
 * @package App\Libs\Traits
 *
 * @property-read JsonRespone $response
 */
trait ApiResponse
{
    public function ok()
    {
        return response()->json(
            $this->response->toArray(),
            Response::HTTP_OK
        );
    }

    /**
     * Respond not found
     *
     * @param  array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound(array $headers = [])
    {
        return response()->json([
            'message' => $this->response->message,
            'code' => $this->response->code,
        ], Response::HTTP_NOT_FOUND, $headers);
    }

    /**
     * Respond forbidden
     *
     * @param  array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function forbidden(array $headers = [])
    {
        return response()->json([
            'message' => $this->response->message ?: 'Access denied'
        ], Response::HTTP_FORBIDDEN, $headers);
    }

    /**
     * Basic handle exception
     *
     * @param Exception   $exception
     * @param string|null $message
     * @param bool        $notify
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleException(Exception $exception, string $message = null)
    {
        $message = $message ?: $exception->getMessage();

        $this->response->failed($message, $exception->getCode());

        if ($exception->getCode() === Response::HTTP_FORBIDDEN) {
            return $this->forbidden();
        }

        return $this->ok();
    }

    /**
     * @param $name
     *
     * @return JsonRespone()|null
     */
    public function __get($name)
    {
        if ('response' === $name) {
            $this->response = new JsonRespone();
            return $this->response;
        }
        return null;
    }
}
