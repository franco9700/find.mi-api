<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
    ];

    public function jobs(){
    	return $this->hasMany('App\Job');
    }
}
