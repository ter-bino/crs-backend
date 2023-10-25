<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $response = [
        'error' => [
            'message' => 'This is an API only Laravel backend. Please use /api endpoint.'
        ],
        'status' => 404,
    ];

    return response()->json($response, 404);
});
