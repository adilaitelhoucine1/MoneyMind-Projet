<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Ajoute cette ligne

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
}
