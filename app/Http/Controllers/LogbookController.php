<?php

namespace App\Http\Controllers;

use App\Logbook;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(auth()->user()->hasrole('teacher')){

            $students = Student::where('teacher_id', auth()->user()->id)->get();
            $logbooks = Logbook::where('teacher_id', auth()->user()->id)->get();

        }else if(auth()->user()->hasrole('parent')){

            if(request('child')){ // kalau dia pilih nak tengok anak yg mana punya logbook

                $students = '';
                $logbooks = Logbook::where('student_id', request('child'))->parent(auth()->user()->id)->get();

                // echo json_encode($logbooks);

            }else{

                $students = Student::where('parent_id', auth()->user()->id)->get();

                $mychild = array();

                foreach($students as $c){

                    array_push($mychild, $c->id);
                }

                $logbooks = Logbook::myChild($mychild)->get();
            }

        }else{

            $students = Student::all();
            $logbooks = Logbook::all();
        }

        return view('logbook')->with('active','logbook')
                                ->with('formwizard',true)
                                ->with('students', $students)
                                ->with('logbooks', $logbooks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $time = request('time');
        // $milk_1 = request('milk_1');
        // $milk_2 = request('milk_2');

        // echo $time;

        // echo json_encode(request('dypers'));

        $logbook = new Logbook;

        $logbook->teacher_id = auth()->user()->id;
        $logbook->student_id = request('id');
        $logbook->time = request('time');
        $logbook->date = request('date');
        $logbook->sender = request('sender');
        $logbook->is_healthy = request('is_healthy');
        $logbook->illness = json_encode(request('illness')); // guna json_encode sbb value dia array
        $logbook->equipment = request('equipment');
        $logbook->medicine = request('medicine');
        $logbook->milk_1 = request('milk_1');
        $logbook->milk_2 = request('milk_2');
        $logbook->breakfast = request('breakfast');
        $logbook->lunch = request('lunch');
        $logbook->teatime = request('teatime');
        $logbook->circle_time = request('circle_time');
        $logbook->outdoor = request('outdoor');
        $logbook->dypers = json_encode(request('dypers'));
        $logbook->dypers_info = request('dypers_info');
        $logbook->brush_teeth = json_encode(request('brush_teeth'));
        $logbook->bath = json_encode(request('bath'));
        $logbook->sleep = json_encode(request('sleep'));
        $logbook->additional_note = request('additional_note');

        $logbook->save();

        return redirect('logbook');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function show(Logbook $logbook)
    {
        return view('logbook.viewlogbook')->with('logbook',$logbook)->with('active','logbook');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logbook $logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logbook $logbook)
    {
        //
    }
}
