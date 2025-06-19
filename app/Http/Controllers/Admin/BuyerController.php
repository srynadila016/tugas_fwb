<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = User::where('role', 'pembeli')->paginate(10);
        return view('admin.buyers.index', compact('buyers'));
    }
}