<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    protected $table = 'mentions';
    protected $fillable = ['sentence', 'start', 'end', 'description'];

    public function inSentence(){
    	return $this->belongsTo('App\Sentence', 'sentence');
    }
}
