<?php

namespace App\Http\Controllers;

use App\Logbook;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){

    	$total_students = Student::count();

    	$total_teacher = User::role('teacher')->count();
    	$total_parent = User::role('parent')->count();

    	$total_logbooks = Logbook::count();
    	
    	return view('admin.dashboard')->with('active','dashboard')
    								->with('total_parent',$total_parent)
    								->with('total_teacher',$total_teacher)
    								->with('total_students', $total_students)
    								->with('total_logbook', $total_logbooks);
    }

    public function panel(){

    	$total_students = Student::count();

    	$total_teacher = User::role('teacher')->count();
    	$total_parent = User::role('parent')->count();

    	$total_logbooks = Logbook::count();
    	
    	return view('admin.dashboard')->with('active','dashboard')
    								->with('total_parent',$total_parent)
    								->with('total_teacher',$total_teacher)
    								->with('total_students', $total_students)
    								->with('total_logbook', $total_logbooks);
    }
}
