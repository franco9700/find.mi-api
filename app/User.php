<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'birthdate',
        'gender',
        'phone',
        'address',   
        'email', 
        'password', 
    ];

    protected $attributes = [
        'score' => 0, 
        'profile_img' => null, 
        'role' => 'cliente',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Sets the crypted password attribute.
     *
     * @param      <string>  $password  The password
     */
    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function usersProvider()
    {
        return $this->belongsTo('App\UsersProvider');
    }

    public function providersCommentaries()
    {
        return $this->hasMany('App\ProvidersCommentary');
    }

    public function providersServices()
    {
        return $this->hasMany('App\ProvidersService');
    }
}
