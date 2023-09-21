<?php

namespace App\Http\Middleware;

use Closure;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $administrator_list = config('constants.administrator_usernames');

        // This code was commented by Dominick on 21/09/2023 to implement it i the first if statement below using different semantics
        // if (!empty($request->user()) && in_array(strtolower($request->user()->username), explode(',', strtolower($administrator_list)))) {
        //     return $next($request);
        // } 
        $list = json_decode($administrator_list, true);
        if (!empty($request->user()) && in_array($request->user()->username, $list)) {
            return $next($request);
        } 
        else {
            abort(403, 'Unauthorized action.');
        }
    }
}
