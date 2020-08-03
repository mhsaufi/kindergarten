<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasrole('teacher')){

            $feedbacks = Feedback::where('teacher_id', auth()->user()->id)->get();
            $active = 'feedback';

        }else if(auth()->user()->hasrole('parent')){
            if(request('child')){
                $feedbacks = Feedback::where('parent_id', auth()->user()->id)->where('student_id',request('child'))->get();
            }else{
                $feedbacks = Feedback::where('parent_id', auth()->user()->id)->get();
            }
            
            $active = 'inbox';

        }else{

        }

        return view('feedback')->with('active', $active)->with('feedbacks', $feedbacks);
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
        $feedback = new Feedback;

        $feedback->student_id = request('student_id');
        $feedback->parent_id = request('parent_id');
        $feedback->teacher_id = auth()->user()->id;
        $feedback->subject = request('subject');
        $feedback->content = request('content');
        $feedback->save();

        return redirect()->back()->withErrors(['Message successfully sent to parent!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
