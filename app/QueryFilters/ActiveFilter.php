<?php

namespace App\QueryFilters;

use Closure;

class ActiveFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        return $builder->where('is_active', true);
    }
}