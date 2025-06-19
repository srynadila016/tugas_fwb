<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction; 
class DashboardController extends Controller
{
    public function index()
    {


        // Kirimkan semua variabel ini ke view 'admin.dashboard'
        return view('buyer.dashboard');
        return view('admin.dashboard');
        return view('owner.dashboard');
        //                                      ^______________________________________________________^
        //                                                      Variabel-variabel ini yang dikirim ke view
    }
}

