<?php

namespace App\Traits;

trait HasJsonResponse
{
    /**
     * Send success message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccessMessage($data = null, $message = null, $status = null)
    {
        if ($data !== null) {
            $default = [
                'message'   => $message ?? 'Операция прошла успешно!',
                'status'    => $status ?? 200,
            ];
            return response()->json(array_merge($default, $data));
        }
        return response()->json([
            'message'   => $message ?? 'Операция прошла успешно!',
            'status'    => $status ?? 200,
        ]);
    }

    /**
     * Send error message
     * @param $error
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendErrorMessage(string $message = null, int $status = null)
    {
        return response()->json([
            'message'   => $message ?? 'Произошла ошибка! Пожалуйста, попробуйте еще раз',
            'status'    => $status ?? 500,
        ])->setStatusCode($status);
    }

    /**
     * Send authorization token
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccessMessageWithToken(array $data)
    {
        $default = [
            'message'    => 'Авторизация прошла успешно!', 
            'status'     => 200,
        ];
        return response()->json(array_merge($default, $data));
    }

    /**
     * Send unauthorized message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendUnauthorizedMessage($message = null)
    {
        return response()->json([
            'message'   => $message ?? 'Unauthorized',
            'status'    => 401,
        ]);
    }

    /**
     * Send logged out message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendLoggoutMessage($message = null)
    {
        return response()->json([
            'message' => $message ?? 'Successfully logged out',
            'status'  => 200,
        ]);
    }

    
    /**
     * Send error message related to token
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendTokenErrorMessage($message) 
    {
        return response()->json([
            'message' => $message,
            'status'  => 401
        ]);
    }
}
