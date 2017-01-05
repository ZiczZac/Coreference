<?php

namespace App\Lib;

use App\FileRevised;

trait FileTrait {
    public function getFileLabeling($files){
    	$listFile = [];
    	foreach ($files as $file) {
    		// dd($this->isFileFinish($file->id));
    		if(!$this->isFileFinish($file->id)){
    			// dd($this->isFileFinish($file->id));
    			$listFile[] = $file;
    		}
    	}
    	return $listFile;
    }

    public function isFileFinish($file_id){
    	$fileReviseds = FileRevised::where('file', '=', $file_id)->get();
    	if($fileReviseds->first() == null){
    		return false;
    	} else {
    		$finishedFile = FileRevised::where('file', '>=', $min_labeling)->get();
	    	if($finishedFile.count() ){
	    		return true;
	    	} else {
	    		return false;
	    	}
    	}
    	
    }

    public function getMinLabeling($fileRevised){
    	return $fileRevised->task['min_labeling'];
    }
}