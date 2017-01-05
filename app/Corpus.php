<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpus extends Model
{
    protected $table = "corpus";
    protected $fillable = ['name', 'description'];

    public function file(){
    	return $this->hasOne('App\File');
    }
}
