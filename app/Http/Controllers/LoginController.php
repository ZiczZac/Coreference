<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    public function login(Request $request){

    	
    	$login = [
    		'email' => $request->email, 
    		'password' => $request->password
    	];
        // $query = 'email = '. $login['email'].' and password = '. $login['password'];
        $query = 'email = ? and password = ?';
        // dd($query);
        $user = User::where('email', '=', $login['email'])
                        ->where('password', '=', $login['password'])->get();
    	dd($user);
    	if ($user) {
            // Authentication passed...
            return "login successfully!!";
        } else {
        	return "fail";
        }
    }

    public function logout(){

    }

    public function show(){
    	return view('auth.login');
    }
}
