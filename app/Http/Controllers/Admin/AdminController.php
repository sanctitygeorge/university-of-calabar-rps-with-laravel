<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Admin;
 
class AdminController extends Controller
{
   

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
	

    /**
    * Redirect admin after login
    */

    protected $redirectTo = '/adminHomePage';


    protected function guard()
    {
    	return Auth::guard('admin');
    }


	/**
     * Create a new controller instance.
     *
     * @return void
     */
 
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function admin()
    {
        return view('admin');
    }


    public function register()
    {
        return view('auth.admin-register');
    }


    public function createAdmin(Request $request)
    {
            $this->validate($request, array(
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                 ));
        

                $admin = Admin::create([
                    'firstName' => $request['firstName'],
                    'lastName' => $request['lastName'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
                return redirect()->route('admin.dashboard')
                ->with('success_message', 'New Admin Created!!');     
        }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginPage()
    {
        return view('admin.login');
    }


}