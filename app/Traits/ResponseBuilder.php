<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ResponseBuilder
{
    public function success($data, $message = "success",  $code = Response::HTTP_OK)
    {
        return response([
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public function error($message,  $code)
    {
        return response([
            'code' => $code,
            'message' => $message,
        ], $code);
    }
}
