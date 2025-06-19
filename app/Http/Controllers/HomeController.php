<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->isOwner()) {
                return redirect()->route('owner.dashboard');
            } elseif (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->isPembeli()) {
                return redirect()->route('buyer.dashboard');
            }
        }
        return view('auth.login'); // Or a landing page
    }
}