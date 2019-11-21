<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    	'providers_service_id',
    	'jobs_status_id',
        'short_description', 
        'detailed_description', 
    ];

    public function providersService(){
    	return $this->belongsTo('App\ProvidersService');
    }

    public function jobsStatus(){
    	return $this->belongsTo('App\JobsStatus');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
