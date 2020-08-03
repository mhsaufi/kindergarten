<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    public function parent(){

    	return $this->hasOne(User::class, 'id', 'parent_id');
    }

    public function teacher(){

    	return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function logbook()
    {
    	return $this->hasMany(Logbook::class, 'student_id','id');
    }
}
