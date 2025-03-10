<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated($request, $user)
    {
        dd([
            'role' => $user->role,
            'user' => $user,
            'intended_route' => $user->role === 'admin' ? '/admin/dashboard' : '/User/dashboard'
        ]);
        
        // switch($user->role) {
        //     case 'admin':
        //         return redirect('/admin/dashboard');
        //     case 'user':
        //         return redirect('/User/dashboard');
        //     default:
        //         return redirect('/test');
        // }
        if($user->role === 'user'){
          
            return redirect('/User/dashboard');
        }
        if($user->role === 'admin'){
            return redirect('/admin/dashboard');
        }
        
    }
} 