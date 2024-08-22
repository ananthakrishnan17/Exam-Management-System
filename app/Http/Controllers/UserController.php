<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\Master;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'firstName' => 'required|regex:/^[A-Z]+$/i',
                'lastName' => 'required|regex:/^[A-Z]+$/i',
                'gender' => 'required',
                'dob' => 'required|date|before:-18 years',
                'maritialStatus' => 'required',
                'email' => 'required|email|unique:t_employee_details,email',
                'degree' => 'required',
                'address' => 'required',
                'contactNumber' => 'required|numeric|regex:/^\d{10}(\d{2})?$/|unique:t_employee_details,contact_number',
                'passedout_year' => 'required|numeric|digits:4|after_or_equal:' . now()->subYears(3)->format('Y'),
                'cgpa' => 'required|numeric|between:0.00,10.00',
            ],
            [
                'firstName.required' => 'Please Enter the First Name',
                'firstName.regex' => 'Please Enter the only Alphabetical value',
                'lastName.required' => 'Please Enter the Last Name',
                'lastName.regex' => 'Please Enter the only Alphabetical value',
                'dob.required' => 'Please select the DOB',
                'dob.before' => 'You are not 18 Years Old',
                'gender.required' => 'Please select the gender',
                'maritialStatus.required' => 'Please select the Maritial status',
                'email.required' => 'Please Enter the Email Address',
                'email.email' => 'Please Enter the Valid Email Address',
                'email.unique' => 'Email already registered',
                'degree.required' => 'Please select the Degree',
                'contactNumber.required' => 'Please Enter your Contact number',
                'contactNumber.numeric' => 'Please Enter the number only',
                'contactNumber.regex' => 'Please Enter the contact number 10 or 12 digits only',
                'contactNumber.unique' => 'Contact Number already registered',
                'address.required' => 'Please Enter Your Address',
                'passedout_year.required' => 'Please Enter your Passedout year',
                'cgpa.required' => 'Please Enter your CGPA'
            ]
        );

        $adminIds = session()->get('admin_id');

        $regId = User::latest('id')->first();
        $regUserId = $regId ? (int) substr($regId->user_id, 3) : 0;
        $regId = 'USR' . str_pad($regUserId + 1, 4, '0', STR_PAD_LEFT);
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $dob = $request->input('dob');
        $maritialStatus = $request->input('maritialStatus');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $degree = $request->input('degree');
        $contactNumber = $request->input('contactNumber');
        $address = $request->input('address');
        $passedout_year = $request->input('passedout_year');
        $cgpa = $request->input('cgpa');
        $created_by = $adminIds;

        DB::insert("insert into t_employee_details(user_id,first_name,last_name,dob,marital_status,gender,email,contact_number,address,degree_id,year_of_graduation,cgpa,created_by) values (?,?,?,?,?,?,?,?,?,?,?,?,?)", [$regId, $firstName, $lastName, $dob, $maritialStatus, $gender, $email, $contactNumber, $address, $degree, $passedout_year, $cgpa, $created_by]);
        return redirect('user/list');
    }

    public function create()
    {
        $degrees = Master::all();
        return view('user.register', compact('degrees'));
    }

    public function user_list()
    {
        $user_pagination_limit = Session::get('user_pagination_limit');
        $students = User::orderBy('created_date', 'asc')->paginate($user_pagination_limit); // Pagination limit
        $degrees = Master::all();
        return view('user/list', ['students' => $students, 'degrees' => $degrees, 'user_pagination_limit' => $user_pagination_limit]); 
    }

    public function use_notuse($id)
    {
        $users = User::find($id);
        if ($users) {
            if ($users->use_notuse) {
                $users->use_notuse = 0;
            } else {
                $users->use_notuse = 1;
            }
            $users->save();
        }
        return back();
    }

    public function gender($id, $newGender)
    {
        $users = User::find($id);
        if ($users) {
            // Assuming 0 represents 'male', 1 represents 'female', and 2 represents 'others'
            if ($newGender >= 0 && $newGender <= 2) {
                $users->gender = $newGender;
                $users->save();
            }
        }
        return back();
    }

    public function maritial($id)
    {
        $users = User::find($id);
        if ($users) {
            if ($users->marital_status) {
                $users->marital_status = 0;
            } else {
                $users->marital_status = 1;
            }
            $users->save();
        }
        return back();
    }

    public function delete($id)
    {
        DB::delete("delete from t_employee_details where id=?", [$id]);
        return back();
    }

    //admin list view
    public function admin_list()
    {
        $students = DB::select("select * from t_employee_details");
        $degrees = Master::all();
        return view('AdminContent.Adminpage', ['students' => $students, 'degrees' => $degrees]);
    }

    public function view($id)
    {
        $user = User::find($id);

        $studentDegree = DB::table('m_degrees')
            ->join('t_employee_details', 'm_degrees.id', '=', 't_employee_details.degree_id')
            ->where('t_employee_details.id', $id)
            ->select('m_degrees.degree_name')
            ->first();

        return view('user/view', ['student' => $user, 'studentDegree' => $studentDegree]);
    }

    public function edits($id)
    {
        $user = User::findOrFail($id);
        $degrees = Master::all();
        return view('user.edit', compact('user', 'degrees'));
    }

    public function user_update(Request $request, $id)
    {
        $request->validate(
            [
                'first_name' => 'required|regex:/^[A-Z]+$/i',
                'last_name' => 'required|regex:/^[A-Z]+$/i',
                'dob' => 'required|date|before:-18 years',
                'gender' => 'required',
                'marital_status' => 'required',
                'email' => 'required|email',
                'degree' => 'required',
                'address' => 'required',
                'contact_number' => 'required|numeric|regex:/^\d{10}(\d{2})?$/',
                'yearof_graduation' => 'required|numeric|digits:4|after_or_equal:' . now()->subYears(3)->format('Y'),
                'cgpa' =>  'required|numeric|between:0.00,10.00',
            ],
            [
                'first_name.required' => 'Please Enter the First Name',
                'last_name.required' => 'Please Enter the Last Name',
                'dob.required' => 'Please select the DOB',
                'dob.before' => 'You are not 18 Years Old',
                'gender.required' => 'Please select the gender',
                'marital_status.required' => 'Please select the Maritial status',
                'email.required' => 'Please Enter the Email Address',
                'email.email' => 'Please Enter the Valid Email Address',
                'degree.required' => 'Please select the Degree',
                'contact_number.required' => 'Please Enter your Contact number',
                'contact_number.numeric' => 'Please Enter the number only',
                'contact_number.digits:10' => 'Please Enter the 10 or 12 digits',
                'address.required' => 'Please Enter Your Address',
                'yearof_graduation.required' => 'Please Enter your Passedout',
                'cgpa.required' => 'Please Enter your CGPA',
            ]
        );
        $user = User::findOrFail($id);
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'marital_status' => $request->input('marital_status'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'cgpa' => $request->input('cgpa'),
            'year_of_graduation' => $request->input('yearof_graduation'),
            'degree_id' => $request->input('degree'),
            $adminId = session()->get('admin_id'),
            'updated_by' =>  $adminId,
        ]);
        return redirect('user/list');
    }
}
