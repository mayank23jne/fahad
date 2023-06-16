<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request,Closure $next)
    {
        // return abort(403);
        $admin =  Admin::find($request->id);
        if ($admin->role_id == 1 || $admin->role_id == 3){
            // return abort(403);
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
