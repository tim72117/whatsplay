<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'title',
    ];

    public function plays()
    {
        return $this->hasMany(Play::class);
    }
}
