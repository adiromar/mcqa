<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $category = Category::orderBy('created_at', 'desc')->get();
        // $category = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('index')->with('category', $category);
    }
}
