<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @apiDefine Games
 * @apiSuccess {Object[]} games List of Games.
 * @apiSuccess {String} games.created_at Firstname of the User.
 */

Route::middleware('auth:api')->group(function () {
    /**
     * @api {post} /my/region/:id/games Create game in region
     * @apiDescription 新增區域的比賽
     * @apiName PostMyRegionGames
     * @apiGroup Game
     * @apiParam (id) {Number} id Regions unique ID.
     * @apiUse Games
     */
    Route::post('/my/region/{region_id}/games', 'GameController@create');

    /**
     * @api {get} /my/games Get my games
     * @apiDescription 取得使用者開啟的比賽
     * @apiName GetMyGames
     * @apiGroup Game
     * @apiUse Games
     * @apiHeader {String} Authorization Authorization value.
     * @apiHeaderExample {json} Request-Example:
     *      {
     *          "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI....."
     *      }
     */
    Route::get('/my/games', 'GameController@index');

   /**
     * @api {delete} /my/game/:id Delete game of user
     * @apiDescription 刪除使用者開啟的比賽
     * @apiName DeleteMyGame
     * @apiGroup Game
     * @apiParam (id) {Number} id Games unique ID.
     *
     */
    Route::delete('/my/game/{game_id}', 'GameController@delete');

    /**
     * @api {get} /my/visit/games Get visit games of user
     * @apiDescription 取得使用者參加的比賽
     * @apiName GetMyVisitGames
     * @apiGroup Visit
     *
     */
    Route::get('/my/visit/games', function () {
        return Auth::user()->games()->wherePivot('home', false)->get()->load('region');
    });

    /**
     * @api {post} /my/visit/game/:id Join game
     * @apiDescription 加入比賽
     * @apiName PostMyVisitGame
     * @apiGroup Visit
     * @apiParam (id) {Number} id Games unique ID.
     */
    Route::post('/my/visit/game/{game_id}', function ($game_id) {
        Auth::user()->games()->attach($game_id, ['home' => false]);
    });
});

/**
 * @api {get} /region/:id/games Get games in region
 * @apiDescription 取得區域的比賽
 * @apiName GetRegionGames
 * @apiGroup Game
 * @apiParam (id) {Number} id Regions unique ID.
 * @apiUse Games
 */
Route::get('/region/{region_id}/games', function ($region_id) {
    return App\Region::findOrFail($region_id)->games;
});

/**
 * @api {get} /game/:id/visits Get visit players in game
 * @apiDescription 取得比賽的參加人
 * @apiName GetGameVisits
 * @apiGroup Visit
 * @apiParam (id) {Number} id Game unique ID.
 * @apiSuccess {Object[]} Game List of Games.
 * @apiSuccess {String} Game.created_at Firstname of the User.
 */
Route::get('/game/{game_id}/visits', function ($game_id) {
    return App\Game::findOrFail($game_id)->visits;
});

/**
 * @api {get} /regions Get regions
 * @apiDescription 取得地區
 * @apiName GetRegions
 * @apiGroup Region
 * @apiSuccess {Object[]} regions List of Regions.
 * @apiSuccess {String} regions.title Region title.
 */
Route::get('/regions', function () {
    return App\Region::all();
});

/**
 * @api {post} //auth/token Get access token
 * @apiDescription 取得登入權杖
 * @apiName GetOauthToken
 * @apiGroup Auth
 * @apiParam (Parameter) {Number} client_id Client unique ID.
 * @apiParam (Parameter) {String} client_secret Client Secret.
 * @apiParam (Parameter) {String} username User Login Name.
 * @apiParam (Parameter) {String} password User Login Password.
 * @apiSuccess {String} token_type Token Type.
 * @apiSuccess {String} expires_in Expires in Seconds.
 * @apiSuccess {String} access_token Access Token.
 * @apiSuccess {String} refresh_token Refresh Token.
 * @apiParamExample {json} Request-Example:
 *      {
 *          "grant_type": "password",
 *          "client_id": "2",
 *          "client_secret": "pIRWMrKNDRFdCwIHGRZBm44lJ1jRAfhp8Fxe0hBS",
 *          "username": "tim72117@gmail.com",
 *          "password": "123456"
 *      }
 */
