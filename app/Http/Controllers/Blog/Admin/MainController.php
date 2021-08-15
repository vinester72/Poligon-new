<?php

namespace App\Http\Controllers\Blog\Admin;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends BaseController
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
    public function dashboard()
    {
        return view('blog.admin.dashboard');
    }
}
