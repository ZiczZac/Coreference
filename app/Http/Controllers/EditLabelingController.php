<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditLabelingController extends Controller
{
    public function index(){
    	$list_id = \DB::table('labeling_coreference')->select('description')
    								->where('author', '=', Auth::user()->id)
    								->groupBy('description')
    								->get();
    	$list_file = array();
    	foreach ($list_file as $id) {
    		
    	}
    }
}
