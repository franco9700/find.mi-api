<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'rfc',
        'quotation', 
        'description',
    ];

    protected $attributes = [
    	'provider_banner' => null,
    	'quotation' => null,
        'description' => null,
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function providersCommentaries(){
        return $this->hasMany('App\ProvidersCommentary');
    }


}
