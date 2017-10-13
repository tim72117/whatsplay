<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Region;

class GameController extends Controller
{
    public function create($region_id)
    {
        $game = Region::findOrFail($region_id)->games()->create([]);

        Auth::user()->games()->attach($game->id, ['home' => true]);

        return $game;
    }

    public function index()
    {
        return Auth::user()->games()->wherePivot('home', true)->get()->load('region');
    }

    public function delete($game_id)
    {
        return ['detach' => Auth::user()->games()->detach($game_id)];
    }
}
