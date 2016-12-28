<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class AccountType extends Model
{
    protected $table = 'account_types';
    protected $fillable = ['name', 'description'];

    public function users(){
    	return $this->hasMany('App\User', 'account_type');
    }
}
