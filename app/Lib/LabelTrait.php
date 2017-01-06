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
                // dd($np);
                array_push($listNP, $np);
            }
        }

        return $listNP;
    }

    public function convertNP($listNP){
        $nps = array();
        usort($listNP, function ($np1, $np2){
            return $np1->description - $np2->description;
        });
        foreach ($listNP as $np) {
            $encode = $np->sentence . '_' . $np->start . '_' . $np->end . '_' .$np->description ;
            array_push($nps, $encode);
        }
        // dd($nps);
        return $nps;
    }
}