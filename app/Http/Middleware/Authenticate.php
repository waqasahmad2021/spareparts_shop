<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        // echo Auth::user()->sts; exit;
        //dd(Auth::user());
        // if(!empty(Auth::user()) && Auth::user()->sts == 0 ){
        //     echo Auth::user()->sts == "0" ? 'active' : 'deactive';
        // }else{
        //     Session::flash('message', 'This is a message!');
        //     return $next($request);
        // }
        // exit;

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
