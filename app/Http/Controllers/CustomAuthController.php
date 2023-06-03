<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required| email|unique:users',
            'password'=>'required|min:5|max:12'

        ]);
        if ($validator->passes()){
        $USER = new User();
        $USER->name=$request->name;
        $USER->email=$request->email;
        $USER->password=Hash::make($request->password);
        $res = $USER->save();

        return redirect()->route('registration.form')->with('success','Ragistration successfully.');

        }else
        {
            // return with errors
            return redirect()->withErrors($validator)->with('Not success','not added successfully.');
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
                // return redirect('dashboard');
                return redirect()->route('employees.index')->with('success','Login successfully.');

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
