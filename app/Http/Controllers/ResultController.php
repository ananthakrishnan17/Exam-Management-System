<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ResultController 
{
  
     //Disply Result List
     public function index()
        {   
            $paginationLimit = Session::get('result_pagination_limit');

            $questionPatterns = Exam::with('employeeDetails')
                ->select('t_test_answer.user_id', 't_question.question_pattern_id', DB::raw('MIN(t_test_answer.created_date) as created_date'))
                ->leftJoin('t_question', 't_test_answer.question_id', '=', 't_question.id')
                ->groupBy('t_test_answer.user_id', 't_question.question_pattern_id')
                ->paginate($paginationLimit);
            
        
            return view('result.list', compact('questionPatterns'));
        }
     
     //Result view
     public function showResult($userId)
         {
             // Fetch user details from t_test_answer table
             $student = Exam::where('user_id', $userId)
             ->select('t_test_answer.user_id', 't_question.question_pattern_id' ,'t_test_answer.answer' )
             ->leftJoin('t_question', 't_test_answer.question_id', '=', 't_question.id')
             ->first();
 
             // Fetch questions and answers from t_question table
             $questions = DB::table('t_question')
                     ->join('t_test_answer', function ($join) use ($student) {
                     $join->on('t_question.id', '=', 't_test_answer.question_id')
                     ->where('t_test_answer.user_id', $student->user_id);
                     })
                     ->select('t_question.*', 't_test_answer.answer as user_response')
                     ->get();
 
             if (!$student) {
                 return view('error')->with('message', 'Result not found. Please check the user ID.');
             }
 
             // Fetch first name and last name from t_employee_details table
             $employeeDetails = User::where('user_id', $userId)
                 ->select('first_name', 'last_name')
                 ->first();
 
             if (!$employeeDetails) {
                 return view('error')->with('message', 'Employee details not found for the given user ID.');
             }
 
             return view('result.view', compact('student', 'employeeDetails', 'questions'));
        }
}
