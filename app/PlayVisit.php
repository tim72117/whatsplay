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
        'approve',
    ];

    public function getHomeAttribute($value)
    {
        return (boolean) $value;
    }

    public function getApproveAttribute($value)
    {
        return (boolean) $value;
    }
}
