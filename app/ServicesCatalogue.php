<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesCatalogue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',  
    ];

    protected $attributes = [
    	'img' => null,
    ];

    public function providersServices(){

    	return $this->hasMany('App\ProvidersService');
    }

    public function users(){
        return $this->hasManyThrough(
            'App\User',
            'App\ProvidersService',
            'services_catalogue_id',
            'id',
            'id',
            'user_id'
        );
    }
}
