<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesSubCatalogue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'sevices_catalogues_id',
        'title', 
    ];

    public function servicesCatalogue(){
    	return $this->belongsTo('App\ServicesCatalogue');
    }

    public function providersServices(){
        return $this->hasMany('App\ProvidersService');
    }
}
