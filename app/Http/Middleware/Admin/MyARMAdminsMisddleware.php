<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyARMAdminsMisddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           
        
        if(!empty(Auth::check())) {

            if(Auth::user()->user_role == 1) {

                if(Auth::user()->is_deleted == 0) {
                    // redirect('admin');
                    return $next($request);
                    
                } else {

                    $notification = array(
                        'title' => 'Login Denied!',
                        'message' => 'User has already ben deleted. Contact Admin.',
                        'alert-type' => 'danger',
                        'icon' => 'block-helper'
                    );

                    Auth::logout();
                    return redirect('login')->with($notification);
                    // return redirect('login');
                }
                
            } else {
                Auth::logout();
                return redirect('login');
            }
        

        } else {

            Auth::logout();
            return redirect('login');

        }
    
    }

    
}
