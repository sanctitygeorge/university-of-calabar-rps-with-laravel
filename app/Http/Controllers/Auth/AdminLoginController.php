<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
     /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }


    public function login(Request $request)
    {
        // Validate the form adata
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if sucessful, the redirect to their
            return redirect()->intended(route('admin.dashboard'));
        }
        //if unseccessful
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
