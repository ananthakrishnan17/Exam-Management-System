<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserLoginController
{
    public function userauthenticate(Request $request)
    {   
        $request->validate([
            'user_id' => 'required',
            'contact_number' => 'required'
        ], [
            'user_id.required' => 'Please enter the user ID.',
            'contact_number.required' => 'Please enter the contact number.',
        ]);

        $user = User::where('user_id', $request->user_id)->first();

        if ($user && $request->contact_number == $user->contact_number) {
            // Compare contact numbers directly

            $request->session()->put('user_id', $user->user_id);
            return redirect('start/exam');
        } else {
            return back()->with('error', 'Invalid user ID or contact number.');
        }
    }

    public function SetHome(Request $request){

        $request->session()->put('home', 'home');
        
        return redirect('/home');
    }

    public function SetExam(Request $request){

        
        $request->session()->forget('home');
  
        $request->session()->put('exam','started');

        return redirect('exam/aptitudetest');
    }

    public function ForgotExam(Request $request){

            
        $request->session()->forget('exam');   

        return redirect('exam/submit');
    }


    public function logout(Request $request)
    {

        if ($request->session()->has('admin_id')) {
            $request->session()->forget('admin_id');
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
}
