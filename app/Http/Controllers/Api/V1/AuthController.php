<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    use HasJsonResponse;

    protected const ERROR = 'Произошла ошибка! Пожалуйста, попробуйте еще раз.';
    protected const WRONG_CREDENTIALS = 'Произошла ошибка с комбинацией пароля и адреса электронной почты. Пожалуйста, попробуйте еще раз.';
    protected const LOGIN_SUCCESS = 'Авторизация прошла успешно';
    protected const REGISTER_SUCCESS = 'Регистрация прошла успешно';
    protected const USER_NOT_FOUND = 'Пользователь не найден!';
    protected const UNAUTHENTICATED = 'Для доступа к запрашиваемому ресурсу требуется аутентификация!';
    protected const DAY_ACCESS_TOKEN = 1440;
    protected const YEAR_ACCESS_TOKEN = 525600;

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $credentials = $request->only('email', 'phone_number', 'password');
            $user = $data['user'];

            if (is_null($user)) {
                return $this->sendErrorMessage(self::USER_NOT_FOUND, 404);
            }

            if (!$jwt = self::generateJWT($credentials, $data['remember'])) {
                return $this->sendErrorMessage(self::WRONG_CREDENTIALS, 409);
            }
        } catch (\Exception $exception) {
            return $this->sendErrorMessage(self::ERROR, 500);
        }
        $user->update(['access_token' => $jwt['access_token']]);
        $user['access_token_ttl'] = $jwt['ttl'];
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken(Request $request)
    {
        if (Auth::check()) {
            $user = User::where('access_token', $token = $request->bearerToken())
                ->first(['id', 'name', 'email', 'phone_number', 'address']);
            $user['access_token'] = $token;
            return $this->sendSuccessMessage(['user' => $user], self::LOGIN_SUCCESS);
        }

        return $this->sendErrorMessage(self::UNAUTHENTICATED, 401);
    }

    /**
     * @param array $credentials
     * @param bool $remember
     */
    private static function generateJWT(array $credentials, bool $remember = false)
    {
        $ttl = $remember? self::YEAR_ACCESS_TOKEN: self::DAY_ACCESS_TOKEN;
        JWTAuth::factory()->setTTL($ttl);
        
        if ($token = JWTAuth::attempt($credentials)) {
            return ['access_token' => $token, 'ttl' => $ttl];
        }
        
        return $token;
    }
}
