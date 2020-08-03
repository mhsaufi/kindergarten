<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = 'logbook';

    public function student()
    {
    	return $this->belongsTo(Student::class, 'student_id','id');
    }

    public function teacher()
    {
    	return $this->belongsTo(User::class, 'teacher_id','id');
    }

    public function scopeMyChild($query , $ids)
    {
        return $query->whereIn('student_id', $ids);
    }

    public function scopeParent($query, $parent_id)
    {
        return $query
                ->join('student', 'student.id', '=', 'logbook.student_id')
                ->where('student.parent_id', $parent_id);
    }
}
