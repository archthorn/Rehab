<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function doctor(){
        return $this->belongsTo('App\Http\Models\User', 'doctor_id');
    }

    public function diagnosis(){
        return $this->belongsTo('App\Http\Models\Diagnosis', 'diagnosis_id');
    }

    public function treatments(){
        return $this->hasMany('App\Http\Models\Treatment', 'patient_id');
    }

    public function getFullName(){
        return $this->surname.' '.$this->name.' '.$this->middle_name;
    }

}
