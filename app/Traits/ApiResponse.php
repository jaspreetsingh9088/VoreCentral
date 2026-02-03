<?php

namespace App\Traits;

trait ApiResponse
{
    public function sendErrorResponse($message,$code){
        $response = [
            'code' => $code,
            'errors' => $message
        ];
        if ($code == 422) {
            $response = [
                'errors' => $message
            ];
        }
        return response()->json($response, $code);
    }
    public function sendResponse($message, $code, $data = NULL)
    {
        $response = [
            'code' => $code,
            'message' => $message
        ];
        if ($code == 422) {
            $response = [
                'code' => $code,
                'message' => $message
            ];
        }
        if (isset($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }

    public function sendPaginationResponse($message, $data = NULL, $notfound = NULL)
    {
        $response = [
            'code' => 200,
            'message' => (sizeof($data['data']) > 0) ? $message : $notfound,
        ];
        if (isset($data)) {
            $response['data']   = $data['data'];
            $response['links']  = $data['links'];
            $response['meta']   = $data['meta'];
        }
        return response()->json($response, 200);
    }

    // FOR API
    // 422 = validation
    // 401 = unathorise user
    // 200 = success

    // FOR WEB
    // 422 = validation
    // 404 = common error
}
