<?php

namespace App\Http\Middleware;

use Closure;

class TrustedAccess
{
    protected $trustedIPs = [
        '162.241.123.133', //vorecentral
        '127.0.0.1'     //localhost
    ];

    protected $trustedDomains = [
        'vorecentral.com',
        'vore.neuronsit.sg',
        'localhost'
    ];

    public function handle($request, Closure $next)
    {
        $clientIP = $request->ip();
        $clientDomain = $request->getHost();

        if (!in_array($clientIP, $this->trustedIPs) && !in_array($clientDomain, $this->trustedDomains)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}