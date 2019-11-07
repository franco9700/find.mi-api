<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProviders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rfc', 
        'description',
    ];
}
