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
 * @apiDefine GameInfo
 * @apiSuccess {String} game.title 比賽標題.
 * @apiSuccess {String} game.position 比賽地點.
 * @apiSuccess {String} game.start_at 比賽時間.
 * @apiSuccess {Boolean} game.closed 是否結束.
 * @apiSuccess {String} game.updated_at 更新時間.
 * @apiSuccess {String} game.created_at 建立時間.
 * @apiSuccess {Object} game.region 區域.
 * @apiSuccess {String} game.region.title 區域名稱.
 */

Route::middleware('auth:api')->group(function () {
    /**
     * @api {post} /my/region/:id/games Create game in region
     * @apiDescription 新增區域的比賽
     * @apiName PostMyRegionGames
     * @apiGroup Game
     * @apiParam {Number} id 區域代碼.
     * @apiParam {String} title 比賽標題.
     * @apiParam {String} position 比賽地點.
     * @apiParam {String} start_at 比賽時間.
     * @apiSuccess {Object} game 新增的比賽.
     * @apiUse GameInfo
     * @apiHeader {String} Authorization Authorization value.
     * @apiHeaderExample {json} Request-Example:
     *      {
     *          "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI....."
     *      }
     */
    Route::post('/my/region/{region_id}/games', 'GameController@create');

    /**
     * @api {get} /my/games Get games of user
     * @apiDescription 取得使用者開啟的比賽
     * @apiName GetMyGames
     * @apiGroup Game
     * @apiSuccess {Object[]} games 比賽的清單.
     * @apiUse GameInfo
     * @apiSuccess {Object} game.play 比賽的資訊.
     * @apiSuccess {Boolean} game.play.home 是否為主約者.
     * @apiSuccess {Boolean} game.play.approve 是否同意參加.
     */
    Route::get('/my/games', 'GameController@home');

    /**
     * @api {delete} /my/game/:id Delete game of user
     * @apiDescription 刪除使用者開啟的比賽
     * @apiName DeleteMyGame
     * @apiGroup Game
     * @apiParam {Number} id Games unique ID.
     */
    Route::delete('/my/game/{game_id}', 'GameController@delete');

    /**
     * @api {get} /my/visit/games Get visit games of user
     * @apiDescription 取得使用者參加的比賽
     * @apiName GetMyVisitGames
     * @apiGroup Game
     * @apiSuccess {Object[]} games 比賽的清單.
     * @apiUse GameInfo
     * @apiSuccess {Object} game.play 比賽的資訊.
     * @apiSuccess {Boolean} game.play.home 是否為主約者.
     * @apiSuccess {Boolean} game.play.approve 是否同意參加.
     */
    Route::get('/my/visit/games', 'GameController@visit');

    /**
     * @api {put} /my/visit/game/:id Join game
     * @apiDescription 加入比賽
     * @apiName PostMyVisitGame
     * @apiGroup Game
     * @apiParam {Number} id Games unique ID.
     * @apiSuccess {Number[]} attached 加入的使用者ID列表.
     * @apiSuccess {Number[]} detached 移除的使用者ID列表.
     * @apiSuccess {Number[]} updated 更新的使用者ID列表.
     */
    Route::put('/my/visit/game/{game_id}', 'GameController@join');
});

/**
 * @api {get} /region/:id/games Get games in region
 * @apiDescription 取得區域的比賽
 * @apiName GetRegionGames
 * @apiGroup Game
 * @apiParam {Number} id Regions unique ID.
 * @apiSuccess {Object[]} games List of Games.
 * @apiUse GameInfo
 */
Route::get('/region/{region_id}/games', 'GameController@index');

/**
 * @api {get} /game/:id/players Get players of game
 * @apiDescription 取得比賽的參加人
 * @apiName GetGamePlayers
 * @apiGroup Players
 * @apiParam {Number} id Game unique ID.
 * @apiSuccess {Object[]} players List of Players.
 * @apiSuccess {String} players.name 姓名.
 * @apiSuccess {String} players.email EMail.
 */
Route::get('/game/{game_id}/players', 'PlayerController@players');

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
