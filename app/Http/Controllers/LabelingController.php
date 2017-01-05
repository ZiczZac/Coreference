<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Lib\FileTrait;
use App\Lib\LabelTrait;
class LabelingController extends Controller
{
	use LabelTrait,
		FileTrait;

	public function fileLabeling(){
		$files = File::all();
		$fileLabeling = $this->getFileLabeling($files);
		// dd($fileFinshed);
		return \View::make('user.file_manage')
						->with('fileLabeling', $fileLabeling);
	}

	public function corpus(Request $request){
		$file_id = $request['file_id'];
		$file = File::find($file_id);
		
		return response()->json($file->plain['description']);
	}

	public function label($id){

		$file = File::find($id);
		$listNP = $this->getListNP($file);
		$data['listNP'] = $listNP;
		$data['corpus'] = $file->plain->description;
		
		return \View::make('user.labeling')
					->with('data', $data);
	}    
}
