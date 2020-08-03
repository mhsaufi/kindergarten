<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    public function student()
    {
    	return $this->belongsTo(Student::class, 'student_id','id');
    }

    public function teacher()
    {
    	return $this->belongsTo(User::class, 'teacher_id','id');
    }

    public function parent()
    {
    	return $this->belongsTo(User::class, 'parent_id','id');
    }
}
