<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class OperatorLoginController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest:operator');
    }

    public function showLoginForm()
    {
    	return view('auth.operatorLogin');
    }

    public function login(Request $request)
    {
    	$credentials = $this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	if(Auth::guard('operator')->attempt(['email' => $request->email,
    	'password' => $request->password], $request->remember)){
    		return redirect()->intended(route('operator.dashboard'));
    	}

    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
