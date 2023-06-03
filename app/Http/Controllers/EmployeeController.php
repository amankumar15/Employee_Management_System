<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\file;

class EmployeeController extends Controller
{
   public function index()
   {
    $employees = Employee::orderBy('id','ASC')->paginate(5);
    return view('employee.list',['employees' =>$employees]);
   }
   public function create()
   {
        return view('employee.create');
   }
   public function store(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'image'=>'sometimes|image:gif,png,jpeg,jpg'
    ]);
    if ($validator->passes()){
        
        //save data here
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;

         // Upload image here
         if ($request->image) {
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/employees/',$newFileName); // This will save file in a folder
            
            $employee->image = $newFileName;
            $employee->save();
        }

        return redirect()->route('employees.index')->with('success','Employee added successfully.');

        

    }else
    {
        // return with errors
        return redirect()->route('employees.create')->withErrors($validator)->withInput();
    }

   }
   public function edit($id)
   {
    $employee = Employee::findorFail($id);
    return view('employee.edit',['employee'=>$employee]);
   }

   public function update($id, Request $request)
   {


    $validator = Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'image'=>'sometimes|image:gif,png,jpeg,jpg'
    ]);
    if ($validator->passes()){
        
        //save data here
        $employee =  Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;

         // Upload image here
         if ($request->image) {
            $oldImage = $employee->image;
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/employees/',$newFileName); // This will save file in a folder
            
            $employee->image = $newFileName;
            $employee->save();
            file::delete(public_path().'/uploads/employees/'.$oldImage);
        }

        $request->session()->flash('success','Employee added Successfully.');
        return redirect()->route('employees.index')->with('success','Employee added successfully.');

        

    }else
    {
        // return with errors
        return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
    }

   }
   public function destroy($id, Request $request)
   {

    $employee= Employee::findOrFail($id);

    file::delete(public_path().'/uploads/employees/'.$employee->image);

    $employee->delete();

    $request->session()->flash('success','Employee deleted Successfully.');
    return redirect()->route('employees.index');

   }

   }


