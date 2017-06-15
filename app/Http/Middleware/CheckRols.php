<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\EntrustPermission;
use App\Permission;
use App\Role;
use App\User;

class CheckRols
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();

        if ($request->path() == 'clubs/add')
        {
            if ($user->hasRole('admin'))
            {
                return $next($request);
            } 
            else 
            {
                return back()->with('openModal', TRUE);
            }  
        }

        return $next($request);
    }
}
