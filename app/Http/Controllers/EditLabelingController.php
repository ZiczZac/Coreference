<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Lib\LabelTrait;
use App\CoreferenceLabel;
class EditLabelingController extends Controller
{
    use LabelTrait;
    public function index(){
    	$list_id = \DB::table('labeling_coreference')->select('description')
    								->where('author', '=', Auth::user()->id)
    								->groupBy('description')
    								->get();
    	$list_file = array();
    	foreach ($list_id as $id) {
    		array_push($list_file, File::find($id->description));
    	}
        // dd($list_file);
        return \View::make('user.user_editedfile')
                                ->with('list_file', $list_file);
    }

    public function edit($id){

        $file = File::find($id);
        $listNP = $this->getListNP($file);
        $data['listNP'] = $this->convertNP($listNP);
        $data['corpus'] = $file->plain->description;

        $begin_on_file = [];
        $end_on_file = [];
        $list_content_np = [];
        $list_token = explode(' ', $data['corpus']);
        $groupNP = [];
        
        $result_old = CoreferenceLabel::where('author', '=', Auth::user()->id)
                                        ->where('description', '=', $id)
                                        ->get();
        $list_old_id = $this->getOldId($result_old);
        // dd($list_old_id);
        foreach ($data['listNP'] as $np) {
            
            $infos = explode('_',$np);
            $bool = false;
            foreach ($list_old_id as $old) {
                $old_info = explode('_', $old);
                if($infos[4] == $old_info[0]){
                    $bool = true;
                    array_push($groupNP, (int)$old_info[1]);
                    break;
                }
            }
            if($bool == false) array_push($groupNP, -1);
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
        // dd($groupNP);
        $data['groupNP'] = $groupNP;
        $data['begin_on_file'] = $begin_on_file;
        $data['end_on_file'] = $end_on_file;
        $data['list_content_np'] = $list_content_np;
        $data['list_token'] = $list_token;

        return \View::make('user.userlabeling')->with('data', $data);
    }

    public function getOldId($result_old){
        $list_old_id = [];
        foreach ($result_old as $res_old) {
            array_push($list_old_id, $res_old->mention . '_' . $res_old->cluster);
        }
        return $list_old_id;
    }
}
