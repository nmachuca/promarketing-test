<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @param $response_data
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($response_data, $message, int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $response_data,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param string $error_message
     * @param array $error_details
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error_message, array $error_details = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error_message,
        ];

        if(!empty($error_details)){
            $response['details'] = $error_details;
        }
        return response()->json($response, $code);
    }
}
