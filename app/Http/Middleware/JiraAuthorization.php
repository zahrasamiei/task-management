<?php

namespace App\Http\Middleware;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use App\Services\Utilities\IpService;
use Closure;
use Illuminate\Http\Request;

class JiraAuthorization
{
    public function __construct(
        private IpService $ipService,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @throws LogicException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $whiteListedIps = array_filter(explode(',', config('routing.white_list_ip.jira')));
        $requestIp      = $this->ipService->getRealClientIp($request);

        if (!$this->ipService->checkIp($requestIp, $whiteListedIps)) {
            throw new LogicException(ErrorConstants::UNAUTHORIZED);
        }

        return $next($request);
    }
}
