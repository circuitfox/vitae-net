<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isInstructor()) {
            return view('admin');
        } else {
            return redirect('/patients');
        }
    }
}
