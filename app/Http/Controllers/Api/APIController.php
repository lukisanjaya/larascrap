<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;

class APIController extends Controller
{

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'code'    => 200,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'code'    => 404,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
