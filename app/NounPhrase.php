<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NounPhrase extends Model
{
	public $sentenceNumber;
    public $begin;
    public $end;
    public $content;
    public $pof;
    public function printNounPhrase(){
    	echo "$this->sentenceNumber $this->begin $this->end $this->pof $this->content <br>";
    }
}
