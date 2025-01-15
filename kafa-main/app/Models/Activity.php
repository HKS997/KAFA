<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['activityName', 'activityDescription', 'activityDate', 'activityTime', 'activityTentative'];
    protected $dates = ['date_time'];

    public function postMortems()
    {
        return $this->hasMany(PostMortem::class);
    }

    public function getStatusAttribute()
    {
        if ($this->postMortems->isEmpty()) {
            return 'Ongoing';
        } else {
            $postMortem = $this->postMortems->first();
            return $postMortem->postStatus == 'Finished' ? 'Finished' : 'Ongoing';
        }
    }
}
