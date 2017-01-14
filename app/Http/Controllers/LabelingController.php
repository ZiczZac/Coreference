<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Lib\FileTrait;
use App\Lib\LabelTrait;
use App\CoreferenceLabel;
use Illuminate\Support\Facades\Auth;

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

	public function save(Request $request){
		CoreferenceLabel::where('author', '=', Auth::user()->id)
						->where('description', '=', $request['file'])->delete();
		$coref_has_max_id = CoreferenceLabel::whereRaw('id = (select max(`id`) from labeling_coreference)')->get()->first();
		if($coref_has_max_id == null){
			$max_id = 0;
		} else {
			$max_id = $coref_has_max_id->id;
		}
		// dd($max_id);
		
		$groups = $request['groups'];
		$cluster = count($groups) - 1;
		// dd($groups);
		foreach ($groups as $group) {
			foreach ($group as $infos) {
				$data = explode('_', $infos);
				$coreference = new CoreferenceLabel;
				$coreference->id = $max_id;
				$coreference->mention = $data[4];
				$coreference->cluster = $cluster;
				$coreference->author = Auth::user()->id;
				$coreference->accepted = 0;
				$coreference->description = $request['file'];
				$coreference->save();
				$max_id ++;
			}
			$cluster --;
		}
		// dd($groups);
		return response()->json('Saved Success Fully!!');
	}
}
