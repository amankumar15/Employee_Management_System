<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use session;

class CustomAuthController extends Controller
{
    public function login(){

        return view("auth.login");
    }

    public function registration(){
     
        return view("auth.registration");
    }

    public function registerUser(Request $request)
    {
        // echo 'Value Posted';
        $request->validate ([
            'name'=>'required',
            'email'=>'required| email|unique:users',
            'password'=>'required|min:5|max:12'

        ]);

        $USER = new User();
        $USER->name=$request->name;
        $USER->email=$request->email;
        $USER->password=Hash::make($request->password);
        $res = $USER->save();
        if($res)
        {
            return back()->with('success', 'you have registered');

        }else
        {
            return back()->with('fail', 'Somthing worng');
        }
    }


    public function loginUser(Request $request)
    {
        // echo 'Value Posted';
        $request->validate ([
           
            'email'=>'required| email',
            'password'=>'required|min:5|max:12'

        ]);

        $user = User::where('email','=',$request->email)->first();
       
        if($user)
        {
            if(Hash::check($request->password,$user->password)){

                $request->session()->put('loginId',$user->id);
                return redirect('dashboard');

            }else
            {
                return back()->with('fail', 'worng password');
            }

        }else
        {
            return back()->with('fail', 'worng email');
        }
    }
    public function dashboard()
    {
        $data=array();
        if(session()->has('loginId')){
            $data = User::where('id','=',session()->get('loginId'))->first();
        }
        return view('auth.dashboard',compact('data')); 
    }

    public function logout(){

        if(session()->has('loginId')){
            session()->pull('loginId');
            return redirect('login');

        }
    }
    

}
