<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LandingPageController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        return view('site.index');
    }
}
