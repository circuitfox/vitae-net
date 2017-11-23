<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Password;

class ResetPassword
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
        if ($request->user()->reset_password) {
            $token = $this->broker()->createToken($request->user());
            return redirect()->route('password.reset', ['token' => $token]);
        }
        return $next($request);
    }

    protected function broker() {
        return Password::broker();
    }
}
