<?php

namespace App\QueryFilters;

use Closure;
use App\Models\Type;

class TypeFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (request()->has('type') && request()->filled('type')) {
            $types = Type::whereIn('slug', request('type'))->pluck('id');
            $builder->whereIn('type_id', $types);
        }

        return $builder;
    }
}