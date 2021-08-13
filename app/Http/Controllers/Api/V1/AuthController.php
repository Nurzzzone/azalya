<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\HasJsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    use HasJsonResponse;

    protected const ERROR = 'Произошла ошибка! Пожалуйста, попробуйте еще раз.';
    protected const WRONG_CREDENTIALS = 'Произошла ошибка с комбинацией пароля и адреса электронной почты. Пожалуйста, попробуйте еще раз.';
    protected const LOGIN_SUCCESS = 'Авторизация прошла успешно';
    protected const REGISTER_SUCCESS = 'Регистрация прошла успешно';
    protected const USER_NOT_FOUND = 'Пользователь не найден!';

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'phone_number', 'password');
            $user = $request->validated()['user'];

            if (is_null($user)) {
                return $this->sendErrorMessage(self::USER_NOT_FOUND, 404);
            }

            if (!Auth::attempt($credentials, $request['remember'])) {
                return $this->sendErrorMessage(self::WRONG_CREDENTIALS, 409);
            }
        } catch (\Exception $exception) {
            return $this->sendErrorMessage(self::ERROR, 500);
        }
        return $this->sendSuccessMessage(['user' => $user], self::LOGIN_SUCCESS);
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            User::create($request->validated())
                ->assignRole('user');
        } catch (\Exception $exception) {
            return $this->sendErrorMessage(self::ERROR, 500);
        }
        return $this->sendSuccessMessage(null, self::REGISTER_SUCCESS);
    }
}
