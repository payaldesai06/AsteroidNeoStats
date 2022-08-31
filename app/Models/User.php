<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;
use Config;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password','phone','avatar','is_active','role_id'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAvatarAttribute($value) {
		return $value ? Storage::disk(Config::get('constants.DISK'))->url($value) : '';
	}

    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = @$input ? $input : 2;
    }
     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
