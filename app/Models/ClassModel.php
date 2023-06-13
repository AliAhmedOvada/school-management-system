<?php

namespace App\Models;

use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function students()
    {
        return $this->belongsToMany(Student::class,'class_student','class_id', 'student_id');
    }
    public function lectures()
    {
        return $this->belongsToMany(Lecture::class,'class_lecture','class_id', 'lecture_id');
    }
}
