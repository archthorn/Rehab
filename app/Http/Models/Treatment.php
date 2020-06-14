<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    const STATUS = ['GOES' => 'Проходиться', 'PASSED' => 'Пройдено', 'INTERRUPTED' => 'Перервано'];

    public function patient(){
        return $this->belongsTo('App\Http\Models\Patient', 'patient_id');
    }

    public function course(){
        return $this->belongsTo('App\Http\Models\Course', 'course_id');
    }
}
