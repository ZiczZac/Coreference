<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccountType;
class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $user = User::find(5);
        return \View::make('admin.users.users')
                        ->with('users', $users);
    }

    public function show(){
        
    }

    public function update(Request $request){
        $id = $request['id'];
        $user = User::find($id);
        $user->fullname = $request['name'];
        $user->email = $request['email'];
        $type = 0;
        if($request['type'] == 'admin'){
            $type = 1;
        } else {
            $type = 2;
        }
        $user->account_type = $type;
        $user->save();
        return response()->json($user);
    }

    public function active(Request $request){
        $id = $request['id'];
        $user = User::find($id);
        $to = $user->activated == 0 ? 1:0;
        $user->activated = $to;
        $user->save();

        return response()->json($to);
    }
    public function delete(Request $request){
        $id = $request['id'];
        $user = User::find($id);
        $user->delete();

        return response()->json($id);
    }

    public function create(){

    }
}
