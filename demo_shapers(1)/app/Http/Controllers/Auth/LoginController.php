<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $maxAttempt=3;
    protected $decayMinutes=60;
    protected $site_settings;
  

   

   
    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:interviewer')->except('logout');
    }

    public function adminLoginForm()
    {
        return view('layouts.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'Username_email'=>'required',
            'password'=>'required'
        ]);

        if(filter_var($request->Username_email, FILTER_VALIDATE_EMAIL)!=false){
            if (Auth::guard('admin')->attempt(['email' => $request->Username_email, 'password' => $request->password], $request->get('remember'))) {
                return redirect('admin/dashboard');
            }
            return back()->with('error','Email-Address And Password Are Wrong.');
        }else{
            if (Auth::guard('admin')->attempt(['username' => $request->Username_email, 'password' => $request->password], $request->get('remember'))) {
              
                return redirect('admin/initiate-interview');
            }
            return back()->with('error','Username And Password Are Wrong.');  
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect('/admin/login')->with('success','You have successfully logged out!');
    }
}
