<?php

namespace App\QueryPipeline;

use Closure;

class SearchLastName
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('last_name')) {
            return $next($request);
        }

        return $next($request)->where('last_name', 'LIKE', '%' . request()->input('last_name') . '%');
    }
}
