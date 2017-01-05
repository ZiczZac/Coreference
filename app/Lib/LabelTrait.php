<?php

namespace App\Lib;

use App\FileRevised;
use App\File;
use App\NounPhrase;
trait LabelTrait {
    
    public function getListNP($file){

        $sentences = $file->sentences;
        $listNP = array();
        foreach ($sentences as $sentence) {
            $npInSentence = $sentence->nounphrase;
            foreach ($npInSentence as $np) {
                array_push($listNP, $np);
            }
        }
        return $listNP;
    }
}