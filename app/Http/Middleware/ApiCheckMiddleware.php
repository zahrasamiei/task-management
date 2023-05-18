<?php

namespace App\Http\Middleware;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use App\Traits\ApiRequestTrait;
use Closure;
use Illuminate\Http\Request;

class ApiCheckMiddleware
{
    use ApiRequestTrait;

    /**
     * Handle an incoming request.
     *
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isApiCall($request)) {
            throw new LogicException(ErrorConstants::INVALID_REQUEST);
        }

        return $next($request);
    }
}
