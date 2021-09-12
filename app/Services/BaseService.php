<?php

namespace App\Services;

abstract class BaseService
{
    protected function successResponse($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    protected function errorResponse($message = '', $code = 0, $details = null)
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
            'details' => $details
        ]);
    }
}
