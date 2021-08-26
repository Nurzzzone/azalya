<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Log;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('category') && request()->isNotFilled('category')) {
            return $next($request);
        }
        Log::info(request()->all());

        $category = CategoryModel::where('slug', request('category'))->first();

        $builder = $next($request);
        return $builder->where('category_id', $category->id);
    }
}