<?php

namespace App\QueryPipeline;

use Closure;

class SearchByContact
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('phone') && !request()->has('email')) {
            return $next($request);
        }

        return $next($request)
            ->when(request()->input('phone'), function ($query) {
                $query->whereHas('contacts', function ($q) {
                    return $q->where('contact', 'LIKE', '%' . request()->input('phone') . '%');
                });
            })
            ->when(request()->input('email'), function ($query) {
                $query->whereHas('contacts', function ($q) {
                    return $q->where('contact', 'LIKE', '%' . request()->input('email') . '%');
                });
            });
    }
}
