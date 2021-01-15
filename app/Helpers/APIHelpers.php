<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Log;

class APIHelpers
{
//    public static function apiResponse($is_error, $code, $message, $data)
//    {
//        $result = [];
//        if ($is_error) {
//            $result['success'] = false;
//            $result['code'] = $code;
//            $result['message'] = $message;
//        } else {
//            $result['success'] = true;
//            $result['code'] = $code;
//            $result['message'] = $message;
//            if ($data == null) {
//                $result['message'] = $message;
//            } else {
//                $result['data'] = $data;
//            }
//        }
//        return $result;
//    }

    /**
     * return success json, add payload
     *
     * @param  int  $statusCode
     * @param  null  $data
     * @param $message
     * @return JsonResponse
     */
    public static function success($data = null, $statusCode = 200, $message = 'success')
    {
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
            'data' => $data,
        ], 200);
    }

    /**
     * unauthenticated error
     *
     * @return JsonResponse
     */
    public static function unauthenticated()
    {
        return response()->json([
            'message' => 'unauthenticated',
            'code' => 401,
            'data' => null,
        ], 401);
    }

    /**
     * error
     *
     * @param  int  $statusCode
     * @param  null  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public static function error($data = null, $statusCode = 500, $message = 'error')
    {
        Log::info(json_encode($data));
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
            'data' => $data,
        ], 500);
    }

    /**
     * not found
     *
     * @return JsonResponse
     */
    public static function notFound()
    {
        return response()->json([
            'message' => 'not found',
            'code' => 404,
            'data' => null,
        ], 404);
    }
}
