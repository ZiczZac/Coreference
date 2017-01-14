<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\User;
class FileController extends Controller
{
    public function index(){
    	$files = File::all();
    	// dd($files->user['fullname']);
    	return \View::make('admin.managefile.index')
    					->with('files', $files);
    }

    public function update(Request $request){
    	$file_id = $request['id'];

    	$file = File::find($file_id);
    	$file->name = $request['file_name'];

    	$user = User::where('fullname', '=', $request['importer'])->first();

    	$file->importer = $user->id;

    	$file->save();
    	$data = array(
    		'id' => $file->id,
    		'name' => $file->name,
    		'importer' =>$file->user['fullname']
    		);
    	return response()->json($data);
    }
}
