<?php

namespace App\QueryPipeline;

use Closure;

class SearchFirstName
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('first_name')) {
            return $next($request);
        }

        return $next($request)->where('first_name', 'LIKE', "%" . request()->input('first_name') . "%");
    }
}
