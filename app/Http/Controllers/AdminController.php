<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function users()
{
    $users = User::where('role', '<>', 'admin')->get();
    


    return view('admin.users.index',
    ["users"=>$users]
);
}

public function categories()
{
    return view('admin.categories.index');
}
}
