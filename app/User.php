<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
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
        'role' => "cliente",
        'profile_img' => null,
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

    /**
     * Gets the full name.
     *
     * @return     <string>  The full name.
     */

    public function getFullName(){

        return $fullname = $this->firstname . " " . $this->lastname;

    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
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
