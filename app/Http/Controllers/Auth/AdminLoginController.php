<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Admin;

class AdminLoginController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        $admin = Admin::where('email', 'sanekdr@gmail.com')->first(); //  returns the first record found in the database. If no matching model exist, it returns null
        if($admin == null)
        {
            Admin::create([
              'name' => 'Александр',
              'email' => 'sanekdr@gmail.com',
              'password' => Hash::make('password'),
            ]);
        }


    	return view('auth.adminLogin');
    }

    public function login(Request $request)
    {
    	$credentials = $this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if(Auth::guard('admin')->attempt(['email' => $request->email,
    	'password' => $request->password], $request->remember)){
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    // FOR AJAX

    public function search(Request $request)
    {
        $users = Admin::where('email', $request->q)->first();

        if($users != null){
            return 1;
        }else{
            return "Ничего нет иди домой";
        }
        
    }
}
