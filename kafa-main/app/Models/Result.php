<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentIC',
        'subject_id', // Assuming 'subject_id' is the foreign key column for the subject relationship
        'resultMark',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentIC');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
