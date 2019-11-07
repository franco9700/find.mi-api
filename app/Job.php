<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'short_description', 
        'detailed_description', 
    ];
}
