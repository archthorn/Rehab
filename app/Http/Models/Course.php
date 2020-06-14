<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function treatments(){
        return $this->hasMany('App\Http\Models\Treatment', 'course_id');
    }

    public function activeCourses(){
        return $this->treatments()->where('status', Treatment::STATUS['GOES'])->get();
    }

    public function passedCourses(){
        return $this->treatments()->where('status', Treatment::STATUS['PASSED'])->get();
    }

    public function interruptedCourses(){
        return $this->treatments()->where('status', Treatment::STATUS['INTERRUPTED'])->get();
    }
}
