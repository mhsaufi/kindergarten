<?php

namespace App\Http\Controllers;

use App\User;
use App\ModelHasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $msg;

    public function __construct()
    {
        $this->msg = '';
    }

    public function index()
    {
        $users = User::whereHas('roles', function ($query){

            return $query->whereIn('name',['teacher','parent']);
        })->with('roles')->get();

        // echo $users;


        // with active, for sidenav current page active highlight

        if(auth()->user()->hasrole('admin')){

            return view('admin.users')
                ->with('users', $users)
                ->with('active', 'usermgt');
        }
        
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
        $user = new User;

        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->password = Hash::make('12345678');

        $user->save();


        // save role for this user
        $mhr = new ModelHasRole;

        $mhr->role_id = request('role');
        $mhr->model_type = 'App\User';
        $mhr->model_id = $user->id; // newly creatd user id

        $mhr->save();

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if(auth()->user()->hasrole('admin')){

            $user = User::find(request('id'));

            $user->name = request('name');
            $user->email = request('email');
            $user->phone = request('phone');

            $user->save();


            // save role for this user
            $mhr = ModelHasRole::where('model_id', request('id'))->first();

            $mhr->role_id = request('role');

            $mhr->save();

            return redirect('/users');

        }else{

            $user = User::find(auth()->user()->id);

            $user->name = request('username');
            $user->email = request('email');
            $user->fullname = request('fullname');
            $user->occupation = request('occupation');
            $user->address = request('address');
            $user->phone = request('phone');

            $user->save();

            return redirect()->back()->withErrors(['Profile is updated!']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function parents(){

        $user = new User;

        $parents = $user->studentParent(auth()->user()->id)->get();

        return view('teacher.parent')->with('active','parents')->with('parents', $parents);
    }

    public function cp(){

        $msg = $this->msg;

        return view('auth.cd')->with('active', 'profile')->with('msg',$msg);
    }

    public function reset(Request $request){

        $validator = Validator::make($request->all(),[
            'pwd' => [
                'bail',
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check(request('pwd'), auth()->user()->password)) {
                        $fail('Password is invalid.');
                    }
                },
            ],
            'newpwd' => 'bail|required',
            'newpwd2' => 'same:newpwd'

        ])->validate();

        $user = User::find(auth()->user()->id);

        $user->password = Hash::make(request('newpwd'));

        $user->save();

        $this->msg = "Password successfully updated!";

        return view('auth.cd')->with('active', 'profile')->with('msg',$this->msg);
    }
}
















