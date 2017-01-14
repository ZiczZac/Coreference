<?php

namespace App\Lib;

use App\User;
use App\File;

trait FileTrait {
    public function getHardWroking(){

    }

    public function getLazy(){

    }

    public function numberUser(){
        return count(User::all());
    }

    public function getNewDocumentOnWeek(){
        $newFiles = File::where('imported_date')
    }

    public function getDocumentProcessing(){

    }

    public function getUserNolongerLogin(){

    }

    public function getDocumentOutOfDate(){

    }
}