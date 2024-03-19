<?php

namespace App\Http\Middleware;

use App\Http\Traits\Responsible;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CustomAuthenticate
 *
 * @package App\Http\Middleware
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class CustomAuthenticate
{
   use Responsible;

    public function handle($request, Closure $next, $guard= 'site-user')
    {
        if (Auth::guard($guard)->guest()) {
            if($request->ajax()){
                return $this->errorResponse(__('auth.unauthorized'), [], JsonResponse::HTTP_UNAUTHORIZED);
            }
            abort(401, __('auth.unauthorized'));
        }
        return $next($request);
    }
}