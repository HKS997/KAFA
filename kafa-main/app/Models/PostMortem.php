<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMortem extends Model
{
    use HasFactory;

    protected $fillable = ['postDescription', 'postDate', 'postStatus', 'activity_id'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
