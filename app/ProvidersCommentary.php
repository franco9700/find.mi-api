<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidersCommentary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'users_provider_id','content', 
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function usersProvider(){
    	return $this->belongsTo('App\UsersProvider');
    }
}
