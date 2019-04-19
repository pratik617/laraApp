<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_users = User::count();
        $active_users = User::where('confirmed', 1)->count();
        $inactive_users = User::where('confirmed', 0)->count();

        return view('dashboard', compact('total_users', 'active_users', 'inactive_users'));
    }
}
