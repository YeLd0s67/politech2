<?php

namespace App\Http\Middleware;

use Closure;

class MoldirRole
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
        foreach (\Auth::user()->roles()->get() as $role){

            if ($role->name == 'moldir') {
                return $next($request);
            } else if ($role->name == 'raikhan') {
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            } else{
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            }
        }
    }
}
