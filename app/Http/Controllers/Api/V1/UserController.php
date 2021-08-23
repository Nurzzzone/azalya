<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HasCustomPaginator;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Resources\Order\OrderCollection;
use App\Traits\HasJsonResponse;

class UserController extends Controller
{
    use HasCustomPaginator, HasJsonResponse;

    protected const PER_PAGE = 9;


    /**
     * @return \Illuminate\Http\Response
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
}
