<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'name',
    ];

    public function patients(){
        return $this->hasMany('App\Http\Models\Patient', 'diagnosis_id');
    }
}
