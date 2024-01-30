<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSellerApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get("user");

        if (!$user) {
            return redirect('/login');
        }

        if($user->kodepriv == 2){
            return $next($request);
        }

        return response()->json(['message' => 'Anda bukan seorang penjual.'], 403);

    }
}
