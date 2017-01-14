<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileRevised extends Model
{
    protected $table = 'file_revision_status';
    protected $fillable = ['file', 'revisor', 'task', 
    	'started_date', 'finished_date'];

    public function file(){
    	return $this->belongsTo('App\File', 'file', 'id');
    }

    public function revisor(){
    	return $this->belongsTo('App\User', 'revisor', 'id');
    }

    public function task(){
    	return $this->belongsTo('App\Task', 'task', 'id');
    }
}
