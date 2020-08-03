<?php

namespace App\Http\Controllers;

use App\Student;
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
    public function index()
    {
        $childrens = Student::where('parent_id', auth()->user()->id)->get();

        return view('parent.home')->with('active','home')->with('childrens', $childrens);
    }

    public function profile(){

        return view('profile')->with('active','profile');
    }
}
