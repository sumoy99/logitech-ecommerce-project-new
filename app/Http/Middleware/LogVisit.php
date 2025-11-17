<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next)
    {
        VisitLog::create([
            'ip_address' => $request->ip(),
            'user_id' => Auth::id(),
            'page' => $request->fullUrl(),
            'item_id' => $request->route('item')?->id ?? null, // if route has item
        ]);
    }

}
