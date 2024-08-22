<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\Question;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends BaseController
{
//pattern create controller:
public function quest(Request $request)
{
    // Validate the request data
    $request->validate([
        'question_pattern_id' => 'required|string|unique:t_question_pattern,question_pattern_id',
    ]);

    $adminId = session()->get('admin_id');
    $question = $request->input('question_pattern_id');

    // Check if the pattern already exists
    if (Pattern::where('question_pattern_id', $question)->exists()) {
        return redirect()->back()->withErrors(['question_pattern_id' => 'The question pattern already exists.'])->withInput();
    }


    // If the pattern doesn't exist, proceed to insert it into the database
    DB::insert('insert into t_question_pattern (question_pattern_id,created_by,updated_by) values (?,?,?)', [$question, $adminId, $adminId]);

    // Redirect to the pattern list page
    return redirect('question/pattern-list');
}



//question register in question list page
public function saveData(Request $request)
{
$request->validate([
]);

$questions = [];
foreach ($request->input('question') as $key => $question) {
    $newQuestion = Question::create([
        'question_pattern_id' => $request->input('question_pattern_id'),
        'question' => $question,
        'option1' => $request->input('option1')[$key],
        'option2' => $request->input('option2')[$key],
        'option3' => $request->input('option3')[$key],
        'option4' => $request->input('option4')[$key],
        'answer' => $request->input('answer')[$key],
    ]);
    $questions[] = $newQuestion;
}
    $lastQuestion = end($questions);
    \Log::info('Request Data: ' . json_encode($request->all()));
    return response()->json($lastQuestion);
}

   
//inline edit in question list
public function update(Request $request, Question $question)
{
    $requestData = $request->only(['question', 'option1', 'option2', 'option3', 'option4', 'answer']);
    $question->update($requestData);
    return response()->json(['message' => 'Question updated successfully'], 200);
}

//delete data from the list
public function deleteQuestion($id)
{
    $question = Question::find($id);
    if (!$question) {
        return response()->json(['message' => 'Record not found'], 404);
    }
    $question->delete();
    return response()->json(['message' => 'Record deleted successfully']);
}

//pattern list
public function list()
    {        
        $pattern_pagination_limit = Session::get('pattern_pagination_limit');
        $questionPatterns = Pattern::orderBy('created_date', 'desc')->paginate($pattern_pagination_limit);
        return view('question.patternlist')->with('questionPatterns', $questionPatterns);
    }

//question list - view
public function show(Request $request, $question_pattern_id,)
{

    $questionPatternId = Session::get('question_pattern_id');
    // Fetch data from the first table (Pattern)
    $questionPattern = Pattern::where('question_pattern_id', $question_pattern_id)->get();

    // Fetch data from the second table (Question) for the specific question_pattern_id
    $query = Question::where('question_pattern_id', $question_pattern_id);

    // Apply search query if present and limit it to the specific question_pattern_id
    $searchQuery = $request->input('query');
    if ($searchQuery) {
        // $query->where('question', 'like', "%$searchQuery%");
        $query = Question::Where('question_pattern_id',$question_pattern_id)
        ->orWhere('question', 'LIKE', "%$searchQuery%");
    }
    
    // echo '<script type="text/javascript">alert("No data found");</script>';
    // Fetch filtered data
    $admins = $query->paginate(1000);

    // Pass variables to the view using an associative array
    return view('question.questionlist', [
        'questionPattern' => $questionPattern,
        'todolists' => $admins, // Paginate the filtered result
        'query' => $searchQuery,
    ]);
}



//pattern - register blade
public function showForm()

{
    $userDetails=DB::select("select * from t_employee_details");
    return view('question.patternregister',['userDetails' => $userDetails]);
}

//assigned and unassigned
public function unassigned($questionPatternId)
{
    Pattern::query()->update(['use_notuse' => 0]);
    $pattern = Pattern::find($questionPatternId);
    if ($pattern) {
        $pattern->use_notuse = 1;
        $pattern->save();
    }
    return back();
}

//pattern delete
public function pattern_destroy(Pattern $pattern)
{
    $pattern->delete();

     return back();

}

public function checkQuestionPatternExistence($questionPatternId)
{
    $questionData = Question::where('question_pattern_id', $questionPatternId)->first();

    if ($questionData) {
        // Both question and pattern with the same question_pattern_id exist
        return response()->json(['exists' => true, 'data' => $questionData]);
    } else {
        // Either question or pattern or both do not exist
        return response()->json(['exists' => false, 'data' => null]);
    }
}

public function checkAnswerPatternExistence($questionPatternId)
    {
        // Query to count the number of answered questions within the specified question pattern ID
        $exists = DB::table('t_test_answer')
                    ->join('t_question', 't_test_answer.question_id', '=', 't_question.id')
                    ->where('t_question.question_pattern_id', '=', $questionPatternId)
                    ->exists();

        // Return JSON response indicating whether the question pattern ID exists in t_test_answer table
        if($exists){
            return response()->json(['exists' => true]);
        } else {
            // Either question or pattern or both do not exist
            return response()->json(['exists' => false, 'data' => null]);
        }

        // Return the response
       
    }






public function search(Request $request )
{
    $query = $request->input('query');
    $question_pattern_id = $request->input('idhidden');

    $admins = Question::where('question_pattern_id', 'LIKE', "%{$question_pattern_id}%")
        ->where('question', 'LIKE', "%{$query}%")
        ->get();

    // Check if any results were found
    $noDataFound = $admins->isEmpty();

    // If no data found, display SweetAlert and return
    if ($noDataFound) {
        return back();
    }

    // If data is found, proceed to display the view with data
    return view('question.questionlist', [
        'questionPattern' => $admins,
         'todolists' => $admins,
          'query' => $query, 
          'noDataFound' => $noDataFound
          
    ]);
}





}
 