<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master;
use Illuminate\Support\Facades\Session;

class MasterController
{
    public function graduate(Request $request)
    {
        $request->validate(
            [
                'degree_s' => ['required', 'string', 'regex:/^[a-zA-Z\s\W]+$/'],
                'degree' => ['required', 'string', 'regex:/^[a-zA-Z\s\W]+$/'],
            ],
            [
                'degree_s.required' => 'Please Enter the Degree type',
                'degree.required' => 'Please Enter the Degree',
            ]
        );
        $adminIds = session()->get('admin_id');
        $degree = $request->input('degree');
        $degree_s = $request->input('degree_s');
        $created_by = $adminIds;
        DB::insert("insert into m_degrees(degree_name,degree_name_s,created_by) values (?,?,?)", [$degree, $degree_s, $created_by]);
        return redirect('master/degreelist');
    }

    public function master_list()
    {
        $students = DB::select("select * from m_degrees");
        return view('master.degreelist', ['students' => $students]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        // Check if there are any records in t_employee_details referencing the given $id
        $students = DB::table("t_employee_details")->where('degree_id', $id)->exists();
        // If there are referencing records, return an error response
        if ($students) {
            return response()->json(['message' => 'Cannot delete the degree data because currently it is used in another table .'], 422);
        }
        // If there are no referencing records, proceed with deleting the degree
        DB::table('m_degrees')->where('id', $id)->delete();
        // Return a success response
        return response()->json(['message' => 'Degree data deleted successfully.']);
    }

    public function mastersview($id)
    {
        $user = Master::find($id);
        return view('master.degreeview', ['student' => $user]);
    }

    public function mastersviews($id)
    {
        $user = Master::find($id);
        return view('master.degreeview', ['student' => $user]);
    }

    public function mastersedit($id)
    {
        $user = Master::findOrFail($id);
        return view('master.degreeedit', compact('user'));
    }

    public function masterupdate(Request $request, $id)
    {
        $request->validate(
            [
                'degree_s' => ['required', 'string', 'regex:/^[a-zA-Z\s\W]+$/'],
                'degree' => ['required', 'string', 'regex:/^[a-zA-Z\s\W]+$/'],
            ],
            [
                'degree_s.required' => 'Please Enter the Degree type',
                'degree.required' => 'Please Enter the Degree',
            ]
        );

        $degree_s = $request->input('degree_s');
        $degree = $request->input('degree');
        // Find the existing record by ID and update its degree_name
        $user = Master::findOrFail($id);
        $user->degree_name_s = $degree_s;
        $user->degree_name = $degree;
        $adminIds = session()->get('admin_id');
        $user->updated_by = $adminIds;
        $user->save();

        return redirect('master/degreelist');
    }

    public function pagination(Request $request)
    {
        $pattern_pagination_limit = $request->input('pattern_pagination_limit');
        Session::put('pattern_pagination_limit', $pattern_pagination_limit);
        return redirect('question/pattern-list');
    }

    public function users(Request $request)
    {
        $user_pagination_limit = $request->input('user_pagination_limit');
        Session::put('user_pagination_limit', $user_pagination_limit);
        return redirect('user/list');
    }

    public function AdminListPagintaion(request $request){

        $admin_pagination_limit = $request->input('admin_pagination_limit');

        Session::put('admin_pagination_limit', $admin_pagination_limit);

        return redirect('admin/list');
    }

    public function ResultListpagination(Request $request)
    {
        $result_pagination_limit = $request->input('result_pagination_limit');
        Session::put('result_pagination_limit', $result_pagination_limit);
        return redirect('result/list');
    }

    public function SetPercentage(Request $request)
    {
        $percentage_limit = $request->input('pass_percentage');
        Session::put('pass_percentage', $percentage_limit);
        return redirect('/result/list');
    }
}
