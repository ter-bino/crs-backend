<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\EnrollmentFeeController;
use App\Http\Controllers\Api\SampleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
 * Exposed API endpoints go here
 */
Route::group(['middleware'=>['cors', 'json.response']], function() {
    Route::get('/sample-route', [SampleController::class, 'sampleRoute']);
    Route::apiResource('colleges', CollegeController::class);
});

/*
 * Protected API endpoints go here
 */
Route::middleware('auth:api')->group(function () {
    //not working for now
});