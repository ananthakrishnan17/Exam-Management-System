<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    public function Adminstores(Request $request){
        $request -> validate([
            'fname' => 'required|regex:/^[A-Z]+$/i',
            'lname' => 'required|regex:/^[A-Z]+$/i',
            'dob' => 'required|date|before:-18years',
            'gender' => 'required',
            'marital' => 'required',
            'contact_no' => 'required|numeric|regex:/^\d{10}(\d{2})?$/|unique:t_admin_details,contact_number',
            'email' => 'required|email|unique:t_admin_details,email',
            'address' => 'required|max:225',
        ],[
            'fname.required' => 'Please Enter the First Name',
            'fname.regex' => 'Please Enter the only Alphabetical value',
            'lname.required' => 'Please Enter the Last Name',
            'lname.regex' => 'Please Enter the only Alphabetical value',
            'gender.required' => 'Please Enter the Gender',
            'dob.required' => 'Please Enter the Date of Birth',
            'dob.before' => 'You are not 18 years old',
            'marital.required' => 'Please Enter the Marital Status',
            'email.required' => 'Please Enter the Email Address',
            'email.email' => 'Invalid Email Address',
            'email.unique' => 'Email already registered',
            'contact_no.required'=> 'Please Enter the Contact Number',
            'contact_no.numeric' => 'Please Enter the Contact Number only in Numeric value',
            'contact_no.regex' => 'Contact Number must be 10 & 12 digits',
            'contact_no.unique' => 'Contact Number already registered',
            'address.required' => 'Please Enter the Address',
        ]);

        $adminIds = session()->get('admin_id');

        $latestAdmin = Admin::latest('id')->first();
        $latestAdminId = $latestAdmin ? (int) substr($latestAdmin->admin_id, 3) : 0;
        $adminId = 'ADM' . str_pad($latestAdminId + 1, 4, '0', STR_PAD_LEFT);

        $firstName = $request -> input('fname');
        $lastName = $request -> input('lname');
        $dob = $request -> input('dob');
        $gender = $request -> input('gender');
        $maritalStatus = $request -> input('marital');
        $email = $request -> input('email');
        $contactNumber = $request -> input('contact_no');
        $address = $request -> input('address');
        $created_by=$adminIds;

        DB::insert("insert into t_admin_details(admin_id,first_name,last_name,dob,gender,marital_status,email,contact_number,address,created_by) values(?,?,?,?,?,?,?,?,?,?)",[$adminId,$firstName,$lastName,$dob,$gender,$maritalStatus,$email,$contactNumber,$address,$created_by]);
        return redirect('admin/list');
    }


    public function student_list(Request $request) {

        $paginationLimit = $request->session()->get('admin_pagination_limit', 10); 
    
        $admins = DB::table('t_admin_details')->paginate($paginationLimit);
    
        return view('admin/list', compact('admins'));
    }

    public function view($id){
        $admins = Admin::find($id);
        return view('admin/view',['admins'=>$admins]);
    }

    public function gender($id, $newGender){
        $admin = Admin::find($id);
        if($admin){
            if($newGender >= 0 && $newGender <= 2){
                $admin->gender = $newGender;
                $admin->save();
            }
        }
        return back();
    }

   public function marital_status($id){
    $admin = Admin::find($id);
    if($admin){
        if($admin->marital_status){
            $admin->marital_status = 0;
        }else{
            $admin->marital_status = 1;
        }
        $admin->save();
    }
    return back();
   }

   public function del_flag($id){
    $admin = Admin::find($id);
    if($admin){
        if($admin->use_notuse){
            $admin->use_notuse = 0;
        }else{
            $admin->use_notuse = 1;
        }
        $admin->save();
    }
    return back();
   }

    public function update(Request $request,$id){
        $validatedData = $request -> validate([
            'first_name' =>'required|regex:/^[A-Z]+$/i',
            'last_name' =>'required|regex:/^[A-Z]+$/i',
            'dob' =>'required|date|before:-18years',
            'gender' =>'required',
            'marital_status' =>'required',
            'contact_number' =>'required|numeric|regex:/^\d{10}(\d{2})?$/',
            'email' =>'required|email',
            'address' =>'required|max:225',
        ],[
            'first_name.required' => 'Please Enter the First Name',
            'last_name.required' => 'Please Enter the Last Name',
            'dob.required' => 'Please select the DOB',
            'dob.before'=>'You are not 18 Years Old',
            'gender.required' => 'Please select the gender',
            'marital_status.required' => 'Please select the Maritial status',
            'email.required' => 'Please Enter the Email Address',
            'email.email'=>'Please Enter the Valid Email Address',
            'contact_number.required' => 'Please Enter your Contact number',
            'contact_number.numeric'=>'Please Enter the number only',
            'contact_number.regex'=>'Please Enter the 10 to 12 digits',
            'address.required'=>'Please Enter Your Address'
        ]);

        $user = Admin::findOrFail($id);
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'marital_status' => $request->input('marital_status'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            $adminId = session()->get('admin_id'),
            'updated_by' =>  $adminId,
        ]);
        return redirect('admin/list');
   }

    public function edit($id){
        $admins = Admin::findOrFail($id);
        return view('admin.edit',['admins'=>$admins]);
    }

    public function delete($id){
        DB::delete("delete from t_admin_details where id = ?",[$id]);
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }

    public function admin_list(){
        $admins = DB::Select("select * from t_admin_details");
        return view('Menu.Admin_list',['admins' => $admins]);
    }

}
