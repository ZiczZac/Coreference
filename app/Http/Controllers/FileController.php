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
    	return \View::make('admin.file.index')
    					->with('files', $files);
    }

}
