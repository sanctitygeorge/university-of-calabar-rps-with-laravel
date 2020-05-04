<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 

class UpdateAdminPasswordController extends Controller
{
    
    public function __construct() 
    {
 
        $this->middleware('auth:admin');
 
    }

    /**
     * Show the form to change the admin password.
     */
    public function index(){
        return view('auth.change-admin-password');
    }
 
    /**
     * Update the password for the admin.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
 
        $admin = Admin::find(Auth::id());
        $hashedPassword = $admin->password;
 
        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $admin->fill([
                'password' => Hash::make($request->password)
            ])->save();
 
            $request->session()->flash('success', 'Your password has been changed.');
 
            return back();
        }
 
        $request->session()->flash('failure', 'Your password has not been changed.');
 
        return back();
 
 
    }
}
