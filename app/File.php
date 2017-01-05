<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
   	protected $table = 'files';
   	protected $fillable = ['name', 'description', 'importer', 'imported_date', 'text', 'corpus'];

   	public function user(){
   		return $this->belongsTo('App\User', 'importer', 'id');
   	}

   	public function plain(){
   		return $this->belongsTo('App\Corpus', 'corpus', 'id');
   	}

   	public function sentences(){
   		return $this->hasMany('App\Sentence', 'file', 'id');
   	}
}
