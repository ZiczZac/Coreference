<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User;
class LoginController extends Controller
{
    public function login(Request $request){
    	$login = [
    		'email' => $request->email, 
    		'password' => $request->password
    	];
        // dd($query);
        $user = User::where('email', '=', $login['email'])
                        ->where('password', '=', $login['password'])->get()->first();
        if($user != null){
           Auth::loginUsingId($user->id);
           return \View::make('home');
        } else {
            return redirect('login');
        }
        
    }
    public function show(){
        return \View::make('auth.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/home');
    }

}
