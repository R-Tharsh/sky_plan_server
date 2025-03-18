<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $message = "Success")
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function errorResponse($message = "Error", $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}