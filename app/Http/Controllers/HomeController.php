<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PpdbUser;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totalPendaftar = PpdbUser::where('nisn', '=', null)->count();
        $totalLengkap = PpdbUser::where('status', '=', 'Final')->count();
        $totalLulus = PpdbUser::where('status', '=', 'Valid')->count();
        return view('dashboard.index', compact('totalPendaftar', 'totalLengkap', 'totalLulus'));
    }
}
