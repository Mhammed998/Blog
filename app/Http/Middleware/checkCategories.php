<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class checkCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!empty(Category::all())){
        return $next($request);
        }else{
            return redirect()->route('dashboard.categories.create');
        }

    }
}
