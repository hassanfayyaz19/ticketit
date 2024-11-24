<?php

namespace Hassanfayyaz19\Ticketit\Middleware;

use Closure;
use Hassanfayyaz19\Ticketit\Models\Agent;
use Hassanfayyaz19\Ticketit\Models\Setting;

class IsAgentMiddleware
{
    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Agent::isAgent() || Agent::isAdmin()) {
            return $next($request);
        }

        return redirect()->route(Setting::grab('main_route'). '.index')
            ->with('warning', trans('ticketit::lang.you-are-not-permitted-to-access'));
    }
}
