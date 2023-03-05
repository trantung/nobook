<?php

namespace App\Libs\Data;

use Illuminate\Contracts\Support\Arrayable;

class Response
{
    /**
     * @var int $success
     */
    public $success = 0;
    /**
     * @var int $code
     */
    public $code = 0;
    /**
     * @var mixed $data
     */
    public $data;

    /**
     * @var string
     */
    public $message = '';

    /**
     * Set status as success
     * @param null $message
     * @param int $code
     * @return Response
     */
    public function succeeded($message = null, $code = 0)
    {
        $this->success = 1;
        $this->message = $message;
        $this->code = (int)$code;
        return $this;
    }

    /**
     * Set status as failed
     * @param null $message
     * @param int $code
     * @return Response
     */
    public function failed($message = null, $code = 0)
    {
        $this->success = 0;
        $this->message = $message;
        $this->code = (int)$code;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = $this->data;
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        return [
            'success' => $this->success,
            'message' => $this->message,
            'code' => $this->code,
            'data' => $data,
        ];
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return $this->{$name} ?? null;
    }
}
