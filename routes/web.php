<?php

use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//normal home

Route::get('/', [UserLoginController::class, 'SetHome']);

Route::group(['middleware' => 'PreventStartTest'], function() {

    Route::view('/home','home.home');
    //UserLogin page route
    Route::view('user/login','user.login');
    Route::any('/Authenticate', [UserLoginController::class, 'userauthenticate']);
    
    //Exam
    Route::get('exam/start',[UserLoginController::class,'SetExam']);
    Route::view('start/exam','exam.start');
    Route::get('start/get/start',[UserLoginController::class,'SetExam']);
});
    
    
    
    //Question View
Route::group(['middleware' => 'PreventQuestionView'], function() {
    
    Route::get('exam/aptitudetest',[ExamController::class,'stud_list']);
    Route::view('exam/start','exam.aptitudetest');
    Route::get('exam/forgot/exam',[UserLoginController::class,'ForgotExam']);
    
    //Ajax submit for answers
    Route::any('/form', [ExamController::class, 'handleFormSubmission']);
});

Route::view('/exam/submit','exam.submit');

Route::view('/Menu1','Menu.MenuLayout1');

//AdminLogin page route
Route::view('admin/login','admin.login');
Route::post('/authenticate', [AdminLoginController::class, 'adminauthenticate']);

//logout
Route::get('/logout',[UserLoginController::class,'logout']);

Route::group(['middleware' => 'PreventBackBtn'], function() {

    //Userlist
    Route::view('user/list','user.list');
    Route::get('user/list',[UserController::class,'user_list']);

    //Userlist delflag
    Route::get('users/{id}',[UserController::class,'use_notuse'])->name('users.notuse');

    //Userlist delete
    Route::get("delete/{id}",[UserController::class,'delete'])->name('users.delete');

    //Userview
    Route::get('user/view/{id}', [UserController::class, 'view']);
    Route::get('user.view', [UserController::class, 'degree']);

    //Useredit
    Route::get('user/edit/{id}', [UserController::class, 'edits'])->name('users.edits');
    Route::put('user_update/{id}', [UserController::class, 'user_update'])->name('users.user_update');

    //Userregister
    Route::view('user/register','user.register');
    Route::post('/store',[UserController::class,'store']);
    Route::get('user/register',[UserController::class,'create']);


    //if SuperAdmin login
    //SuperAdmin Homepage routes
    Route::view('admin/list','admin.list')->name('adminListPage');
    Route::get('admin/list',[AdminController::class,'student_list']);

    //Admin Register
    Route::view('admin/register','admin.register')->name('adminRegister');
    Route::post('Adminstores',[AdminController::class,'Adminstores']);

    //Admin data View
    Route::get('admin/view/{id}',[AdminController::class,'view']);

    //Admin data Update
    Route::get('admin/{id}/edit',[AdminController::class,'edit'])->name('Auth.AdminEdit');
    Route::put('admin/{id}',[AdminController::class,'update'])->name('admins.update');

    //use/notuse change
    Route::get('/{id}',[AdminController::class,'del_flag']);

    //Delete data in list
    Route::get('deletes/{id}',[AdminController::class,'delete'])->name('admin.delete');

    //Master screens

    //Degreeregister
    Route::view('master/degreeregister','master.degreeregister');
    Route::post('/graduate',[MasterController::class,'graduate']);

    //Degreelist
    Route::view('master/degreelist','master.degreelist');
    Route::get('master/degreelist',[MasterController::class,'master_list'])->name('masterlist');
    Route::get('users/masteredit/{id}', [MasterController::class, 'mastersedit'])->name('users.masteredit');

    //Degreelist delete
    Route::post("/delete/{id}", [MasterController::class, 'delete'])->name('users.masterdelete');

    //Degreeview
    Route::get('master/degreeview/{id}', [MasterController::class, 'mastersview']);

    //Degreeedit
    Route::get('master/degreeedit{id}', [MasterController::class, 'mastersedit'])->name('users.masteredit');
    Route::put('users/{id}', [MasterController::class, 'masterupdate'])->name('users.masterupdate');

    //Masterlist
    Route::view('master/masterlist','master.masterlist');

    //Paginationlist
    Route::view('master/paginationlist','master.paginationlist');

    //Pagination limit in Questionlist
    Route::post('/paginationlist', [MasterController::class, 'pagination']);

    //Pagination limit in Userlist
    Route::post('/userlist', [MasterController::class, 'users']);

    //Admin list pagination
    Route::post('/AdminListPagintaion',[MasterController::class, 'AdminListPagintaion']);

    //Result list page pagination
    Route::post('/ResultListPagintaion',[MasterController::class, 'ResultListpagination']);

    //Setpercentageview
    Route::view('master/percentage','master.setpercentage');

    //SetPercentage
    Route::post('/SetPercentage',[MasterController::class, 'SetPercentage']);


    //question list Route

    Route::get('/question/question-list/{question_pattern_id}', [QuestionController::class,'show'])->name('question-list');
    Route::get('question/search/{question_pattern_id?}', [QuestionController::class, 'search'])->name('search');

    //question register
    Route::get('/question-register/{questionPatternId}', [QuestionController::class, 'showQuestionRegisterForm'])
        ->name('question.register');

    //save the question
    Route::post('/saveData',  [QuestionController::class, 'saveData'])->name('save.data');


    //questionlist - Inline edit 
    Route::put('/update-question/{question}', [QuestionController::class, 'update'])->name('update.question');

    //delete data from the list
    Route::post('/delete/question/{id}', [QuestionController::class, 'deleteQuestion'])->name('delete.question');

    //question pattern list
    Route::get('question/pattern-list', [QuestionController::class,'list'])->name('question.pattern-list');

    //question-Pattern-Register
    Route::post('/quest', [QuestionController::class, 'quest']);
    Route::get('/question/pattern-register', [QuestionController::class, 'showForm'])->name('show.form');

    // assinged and unassigned - use and not use
    Route::get('/pattern/use_notuse/unassigned/{id}', [QuestionController::class, 'unassigned'])->name('unassigned');

    //delete pattern
    Route::delete('/pattern/{pattern}', [QuestionController::class, 'pattern_destroy'])->name('pattern.destroy');//delete
    Route::get('/check-question-pattern/{questionPatternId}', [QuestionController::class,'checkQuestionPatternExistence']);
    Route::get('/check-answer/{questionPatternId}', [QuestionController::class,'checkAnswerPatternExistence']);
            

    //Result screen
    Route::view('result/list','result.list');
    Route::get('result/list', [ResultController::class, 'index']);
    //Result view per person
    Route::view('result/view','result.view');
    Route::get('/result/view/{userId}', [ResultController::class, 'showResult'])->name('show.result');
});






