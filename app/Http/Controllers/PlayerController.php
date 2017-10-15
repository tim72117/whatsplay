<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class PlayerController extends Controller
{
    public function players($game_id)
    {
        return Game::findOrFail($game_id)->players;
    }
}
