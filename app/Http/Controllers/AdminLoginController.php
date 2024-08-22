<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminLoginController 
{
    public function adminauthenticate(Request $request)
    {
 
        $request->validate([
            'admin_id' => 'required',
            'password' => 'required'
        ], [
            'admin_id.required' => 'Please enter the userid.',
            'password.required' => 'Please enter the password.',
        ]);
        $admin = Admin::where('admin_id', $request->admin_id)
                        ->where('contact_number', $request->password)->first();

        if ($admin && $request->password === $admin->contact_number){
           
            if ($admin->role == 0) {
              
                $request->session()->put('admin_id', $admin->admin_id);
                $request->session()->put('role', $admin->role);

                // dd($request->session()->get('role'));
                return redirect('/admin/list');
            } if ($admin->role == 1) {
                $request->session()->put('role', $admin->role);
                $request->session()->put('admin_id', $admin->admin_id);
                // dd($request->session()->get('admin_name'));
                return redirect('/user/list');
            } 
        } else {
            return redirect('/admin/login')->with('error', 'Invalid credentials! Please check your credentials',);
            
        }
    }
}
