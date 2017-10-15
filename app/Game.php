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
        'region_id', 'title', 'position', 'start_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'region_id',
    ];

    public function players()
    {
        return $this->belongsToMany(User::class, 'play_visit')->as('play')->using(PlayVisit::class)->withPivot('home', 'approve');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getClosedAttribute($value)
    {
        return (boolean) $value;
    }
}
