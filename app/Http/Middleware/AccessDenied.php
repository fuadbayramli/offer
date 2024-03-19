<?php

namespace App\Http\Middleware;

use App\Http\Traits\Responsible;
use App\Offer;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccessDenied
 *
 * @package App\Http\Middleware
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class AccessDenied
{
    use Responsible;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard= 'site-user')
    {
//        $offer = Offer::find($request->id);

//        if ((int)$offer->user->id !== Auth::guard($guard)->id()) {
        if ((int)$request->id !== Auth::guard($guard)->id()) {
           if($request->ajax()){
               return $this->errorResponse(__('auth.access_denied'), [], JsonResponse::HTTP_FORBIDDEN);
           }
            abort(403, __('auth.access_denied'));
        }

        return $next($request);
    }
}
