<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class User extends Model implements Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'fullname', 'email', 'password', 'account_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function accountType(){
        return $this->belongsTo('App\AccountType','account_type', 'id');
    }

    public function files(){
        return $this->hasMany('App\File');
    }

    
    public function getAuthIdentifier(){
        return $this->id;
    }
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){
        return $this->password;
    }
    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken(){
        return null;
    }
    
    public function setRememberToken($value){

    }
    
    public function getRememberTokenName(){
        return null;
    }

    public function getAuthIdentifierName(){
        return $this->fullname;
    }

}
