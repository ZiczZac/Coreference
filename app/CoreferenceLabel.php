<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreferenceLabel extends Model
{
    protected $table='labeling_coreference';
    protected $filable=['id', 'mention', 'cluster', 'author', 'created_date', 'accepted', '	description'];

    public function getMention(){
    	return $this->belongsTo('App\Mention', 'mention', 'id');
    }

    public function getAuthor(){
    	return $this->belongsTo('App\User', 'author', 'id');
    }
}
