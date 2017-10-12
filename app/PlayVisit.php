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
        'match',
    ];

    public function getMatchAttribute($value)
    {
        return (boolean) $value;
    }
}
