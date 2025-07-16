<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAbility
{
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        $user = $request->user();

        if (!$user || !$user->currentAccessToken()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        foreach ($abilities as $ability) {
            if (!$user->tokenCan($ability)) {
                return response()->json(['message' => 'Forbidden - Missing ability: ' . $ability], 403);
                abort(403,);
            }
        }

        return $next($request);
    }
}
