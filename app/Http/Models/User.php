<?php

namespace App\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function roles()
    {
        return $this->belongsToMany('App\Http\Models\Role', 'user_role');
    }

    public function appointment(){
        return $this->belongsTo('App\Http\Models\Appointment', 'appointment_id');
    }

    public function specialty(){
        return $this->belongsTo('App\Http\Models\Specialty', 'specialty_id');
    }

    public function patients(){
        return $this->hasMany('App\Http\Models\Patient', 'doctor_id');
    }

    public function treatments(){
        return $this->hasManyThrough('App\Http\Models\Treatment', 'App\Http\Models\Patient', 'doctor_id', 'patient_id');
    }

    public function hasRole($role){
        return in_array($role, $this->roles()->pluck('name')->toArray());
    }

    public function getFullName(){
        return $this->surname.' '.$this->name.' '.$this->middle_name;
    }
}
