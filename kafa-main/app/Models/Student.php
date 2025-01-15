<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'studentIC'; // Specify the primary key column
    protected $keyType = 'string'; // Specify the primary key type as string

    protected $fillable = [
        'studentIC', // Assuming 'studentIC' is your primary key
        'studentName',
        'studentAge',
        'studentGender',
        'studentYear',
    ];
}
