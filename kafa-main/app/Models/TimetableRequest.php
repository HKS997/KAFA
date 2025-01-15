<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimetableRequest extends Model
{
    protected $table = 'timetable_request';

    protected $primaryKey = 'requestID';

    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'teacherID',
        'request_day',
        'request_time',
        'request_subject',
        'request_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'teacherID', 'id');
    }

    public function timetable()
    {
        return $this->belongsTo(Timetable::class, 'timetableID', 'id');
    }
}
