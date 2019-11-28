<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidersService extends Model
{
    protected $fillable = [
    	'user_id',
    	'services_sub_catalogue_id',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function servicesCatalogue(){
    	return $this->belongsTo('App\ServicesCatalogue');
    }

    public function jobs(){
        return $this->hasMany('App\Job');
    }
}
