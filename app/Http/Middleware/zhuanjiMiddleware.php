<?php

namespace App\Http\Middleware;

use Closure;

class zhuanjiMiddleware
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
        if($request->input('singer_id')!=0){
            return $next($request);
        }else{
          return redirect('/Album/create');
        }
    }
}
