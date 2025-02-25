<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        
    //dd($user->role);
        // switch($user->role) {
        //     case 'admin':
        //         return redirect()->intended('/admin/dashboard');
        //     case 'user':
        //         return redirect()->intended('/User/dashboard');
        //     default:
        //         return redirect()->intended('/');
        // }
        if($user->role === 'user'){
            return redirect()->route('user.dashboard'); 
        }
        if($user->role==='admin'){
            return redirect()->route('admin.dashboard'); 
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
