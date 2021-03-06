<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Size;
use App\Models\Type;
use App\Models\User;
use App\Models\Format;
use App\Models\Benefit;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAbout;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Resources\ProductResource;

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
            'product' => (new ProductResource($product)),
            'benefits' => Benefit::inProduct()->get(['name', 'image']),
            'interesting' => Product::where('is_active', true)->take(9),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Product $product, Request $request)
    {
        try {
            User::where('access_token', $request->bearerToken())
                ->first()
                ->toggleFavorite($product);
        } catch (\Exception $exception) {
            return $this->sendErrorMessage();
        }
        return $this->sendSuccessMessage();
    }

    public function getFilters()
    {
        try {
            $formats = Format::all(['name', 'slug']);
            $sizes = Size::all(['name', 'slug']);
            $types = Type::all(['name', 'slug']);
            $price['min'] = Product::min('price');
            $price['max'] = Product::max('price');
        } catch (\Exception $exception) {
            return $this->sendErrorMessage();
        }
        return $this->sendSuccessMessage(compact('formats', 'sizes', 'types', 'price'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter()
    {
        $products = (self::MODEL)::filter()
            ->paginate(9);
        return (new ProductCollection($products))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsById(Request $request)
    {
        $products = Product::whereIn('id', $request->products)
            ->get();

        return (new ProductCollection($products))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
