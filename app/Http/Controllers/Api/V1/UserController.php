<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HasCustomPaginator;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Api\V1\Controller;

class UserController extends Controller
{
    use HasCustomPaginator;

    /**
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $products = User::where('access_token', $request->bearerToken())
            ->first()
            ->favorite(Product::class);
        if ($products->isNotEmpty()) {
            return (new ProductCollection($this->paginate($products, 9)))
                ->response()
                ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        return $products;
    }
}
