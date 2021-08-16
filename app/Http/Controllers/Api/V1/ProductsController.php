<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Benefit;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAbout;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Api\V1\Controller;

class ProductsController extends Controller
{
    use HasJsonResponse;

    protected const MODEL = Product::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'products' => Product::where('is_active', true)->paginate(9),
            'categories' => Category::all(['name', 'slug']),
            'about' => ProductAbout::first(['name', 'description']),
        ]);
    }

    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return $this->sendSuccessMessage([
            'product' => $product,
            'benefits' => Benefit::inProduct(),
            'interesting' => Product::where('is_active', true)->take(9),
        ]);
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
