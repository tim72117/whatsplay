<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'region_id',
    ];

    public function visits()
    {
        return $this->belongsToMany(User::class, 'play_visit')->using(PlayVisit::class);
    }
}
