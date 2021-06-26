<?php

use App\Http\Controllers\RtcTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/rtc_token', function (Request $request) {

    $channelName = $request->input('channel_name');

    $uid = $request->input('uid');

    $role = $request->input('role');


    $appID = "a8efaba96f7f414ea0664cbd08e833ac";
    $appCertificate = "e308a14ddbd344e7a9d17f1bdb794530";
    $expireTimeInSeconds = 3600;
    
    $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
    $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

    $token = RtcTokenController::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);

    return $token;

});