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
		return \View::make('user.userfile')
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
		$data['listNP'] = $this->convertNP($listNP);
		$data['corpus'] = $file->plain->description;

		$begin_on_file = [];
		$end_on_file = [];
		$list_content_np = [];
		$list_token = explode(' ', $data['corpus']);
		// dd(count($list_token));
		foreach ($data['listNP'] as $np) {
			
			$infos = explode('_',$np);
			
			array_push($begin_on_file,$infos[3]);
			$end = $infos[3] + $infos[2] - $infos[1];
			array_push($end_on_file, $end);
			$content_np = '';
			for($i = $infos[3]; $i <= $end; $i++){
				if($content_np != ''){
					$content_np .= '_' . $list_token[$i];
				} else {
					$content_np = $list_token[$i];
				}
			}
			array_push($list_content_np, $content_np);
		}

		$data['begin_on_file'] = $begin_on_file;
		$data['end_on_file'] = $end_on_file;
		$data['list_content_np'] = $list_content_np;
		$data['list_token'] = $list_token;
		// dd($data);
		return \View::make('user.userlabeling')
					->with('data', $data);
	}


}
