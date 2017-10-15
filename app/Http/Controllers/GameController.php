<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Region;
use App\Game;

class GameController extends Controller
{
    public function create(Request $request, $region_id)
    {
        $game = Region::findOrFail($region_id)->games()->create([
            'title' => $request->input('title'),
            'position' => $request->input('position'),
            'start_at' => $request->input('start_at'),
        ]);

        Auth::user()->games()->attach($game->id, ['home' => true]);

        return ['game' => $game];
    }

    public function index($region_id)
    {
        return Region::findOrFail($region_id)->games;
    }

    public function home()
    {
        return Auth::user()->games()->wherePivot('home', true)->get()->load('region');
    }

    public function delete($game_id)
    {
        $game = Auth::user()->games()->wherePivot('home', true)->findOrFail($game_id);

        $game->players()->detach();

        return ['deleted' => $game->delete()];
    }

    public function visit()
    {
        return Auth::user()->games()->wherePivot('home', false)->get()->load('region');
    }

    public function join($game_id)
    {
        return Game::findOrFail($game_id)->players()->sync([Auth::user()->id => ['home' => false]]);
    }
}
