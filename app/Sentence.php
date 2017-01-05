<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $table = 'sentences';
    protected $fillable = ['content', 'file', 'description'];

    public function file(){
    	return $this->belongsTo('File', 'file');
    }

    public function nounphrase(){
    	return $this->hasMany('App\Mention', 'sentence', 'id');
    }
}
