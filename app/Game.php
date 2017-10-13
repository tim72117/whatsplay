<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'region_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'region_id',
    ];

    public function visits()
    {
        return $this->belongsToMany(User::class, 'play_visit')->using(PlayVisit::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
