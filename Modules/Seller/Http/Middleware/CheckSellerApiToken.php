<?php

namespace Modules\Seller\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Seller\Entities\SellerAuth;

class CheckSellerApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('token')) {
            /** @var SellerAuth $sellerAuth */
            $sellerAuth = SellerAuth::where('api_token', $request->header('token'))->first();
            if ($sellerAuth) {
                if ($sellerAuth->checkExpireTime()) {
                    return $next($request);
                }
            }

        }
        return abort(401);

    }
}
