<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use App\Traits\HasCustomPaginator;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Order\OrderCollection;

class UserController extends Controller
{
    use HasCustomPaginator, HasJsonResponse;

    protected const PER_PAGE = 9;


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $products = User::where('access_token', $request->bearerToken())
            ->first()
            ->favorite(Product::class);
        if ($products->isNotEmpty()) {
            return (new ProductCollection($this->paginate($products, self::PER_PAGE)))
                ->response()
                ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        return $products;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderHistory(Request $request)
    {
        try {
            $orders = User::where('access_token', $request->bearerToken())
                ->first()
                ->orders;
            $orders = $this->paginate($orders, 9);
        } catch (\Throwable $th) {
            return $this->sendErrorMessage();
        }
        return (new OrderCollection($this->paginate($orders, self::PER_PAGE)))
                ->response()
                ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = User::where('access_token', $request->bearerToken())
            ->first(['name', 'email', 'phone_number', 'address', 'access_token']);

        if ($user !== null) {
            return $this->sendSuccessMessage(compact('user'));
        }

        return $this->sendErrorMessage('Пользователь не найден!');
    }

    /**
     * @param UpdateUserRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request)
    {
        try {
            $user = User::where('access_token', $request->bearerToken());
            $user->update($request->validated());
        } catch (\Exception $exception) {
            return $this->sendErrorMessage();
        }
        return $this->sendSuccessMessage(['user' => $user->first(['name', 'email', 'phone_number', 'address', 'access_token'])]);
    }
}
