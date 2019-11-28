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
}
