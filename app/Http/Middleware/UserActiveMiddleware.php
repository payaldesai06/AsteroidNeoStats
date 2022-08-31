<?php

namespace App\Http\Middleware;

use App\Models\Access\User\User;
use Closure;
use JWTAuth;

class UserActiveMiddleware{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = JWTAuth::parseToken()->authenticate();
		if ($user) {
			if ($user && $user->is_active == 0) {
				return response()->json([
					'message' => 'Your account in not active. Please contact our team.',
					'code'      => 999,
                    'data' => (object)[]
				], 200);
			}
		}
		return $next($request);
	}
}
