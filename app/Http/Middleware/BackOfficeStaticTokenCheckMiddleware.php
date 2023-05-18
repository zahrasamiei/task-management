<?php

namespace App\Http\Middleware;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use Closure;
use Illuminate\Http\Request;

class BackOfficeStaticTokenCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-Snappfood-BO-Token') === config('butler.sf_core.token')){
            return $next($request);
        }

        throw new LogicException(ErrorConstants::UNAUTHENTICATED);
    }
}
