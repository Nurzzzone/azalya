<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;

class ProductsController extends Controller
{
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
}
