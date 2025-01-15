<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
    ];

    /**
     * Get the teacher associated with the timetable.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacherID', 'id');
    }

    /**
     * Get the user associated with the timetable.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    /**
     * Get the timetable requests associated with the timetable.
     */
    public function timetableRequest()
    {
        return $this->hasMany(TimetableRequest::class, 'timetableID', 'id');
    }

    /**
     * Alias for timetableRequests() method.
     */
    public function requests()
    {
        return $this->hasMany(TimetableRequest::class, 'timetableID', 'id');
    }
}
