<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\CategoriesCollection;

class CategoriesController extends Controller
{
    protected const MODEL = Category::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return (new CategoriesCollection((self::MODEL)::all()))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param string $category_slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($category_slug)
    {
        $products = Category::where('slug', $category_slug)
            ->first()
            ->products
            ->where('is_active', true);
        return (new ProductCollection($products))->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
