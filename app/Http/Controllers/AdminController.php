<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Ajoute cette ligne

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function users()
{
    return view('admin.users.index');
}

public function categories()
{
    return view('admin.categories.index');
}
}
