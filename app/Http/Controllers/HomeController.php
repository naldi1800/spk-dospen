<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function admin()
    {
        $page = 'home';
        return view('admin.home.home',  compact(['page']));
    }

    public function ketjur()
    {
        $page = 'home';
        return view('ketjur.home.home',  compact(['page']));
    }
}
