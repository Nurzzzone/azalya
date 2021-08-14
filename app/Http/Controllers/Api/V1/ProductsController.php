<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Traits\HasJsonResponse;

class ProductsController extends Controller
{
    use HasJsonResponse;

    protected const MODEL = Product::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return (new ProductCollection((self::MODEL)::where('is_active', true)->paginate(9)))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function toggleFavorite(Product $product, Request $request)
    {
        try {
            User::authenticated($request)->toggleFavorite($product);
        } catch (\Exception $exception) {
            return $this->sendErrorMessage();
        }
        return $this->sendSuccessMessage();
    }

    public function filter(Request $request)
    {
        $products = (self::MODEL)::filter($request)
            ->where('is_active', true)
            ->paginate(9);
        return (new ProductCollection($products))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
