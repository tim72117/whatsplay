<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayVisit extends Pivot
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'play_visit';

    protected $visible = [
        'home',
        'match',
    ];

    public function getHomeAttribute($value)
    {
        return (boolean) $value;
    }

    public function getMatchAttribute($value)
    {
        return (boolean) $value;
    }
}
