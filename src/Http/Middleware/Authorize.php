<?php

namespace Sandulat\Larabels\Http\Middleware;

use Sandulat\Larabels\Larabels;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return Larabels::check($request) ? $next($request) : abort(403);
    }
}
