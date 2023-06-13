<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class,'class_lecture','class_id', 'lecture_id');
    }
}
