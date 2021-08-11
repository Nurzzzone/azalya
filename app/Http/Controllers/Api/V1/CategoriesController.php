<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Http\Controllers\Controller;
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
}
