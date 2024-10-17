<?php

namespace App\Helpers;

class MassageHandeler
{

    public static function getJsonSuccessResponse(string $msg = "", int $status = 0, object $data = null): object
    {
        return self::responseJson($status, $msg, $data);
    }

    public static function getJsonErrorResponse(string $msg = "", int $status = 0, array $data = []): object
    {
        return self::responseJson($status, $msg, $data);
    }

    private static function responseJson($status, $msg, $data)
    {
        switch ($status) {
            case 200:
                $response = [
                    'status'  => 'success',
                    'code'    => $status,
                    'message' => $msg,
                    'data'    => $data,
                ];
                return response()->json($response, $status);
            case 400:
                $response = [
                    'status'  => 'error',
                    'code'    => $status,
                    'message' => $msg
                ];
                return response()->json($response, $status);
            default:
                $response = [
                    'status'  => 'error',
                    'code'    => 500,
                    'message' => 'can`t handel error status ',
                    'data'    => [],
                ];
                return response()->json($response, $status);
        }

    }
}
