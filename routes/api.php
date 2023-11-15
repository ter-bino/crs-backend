<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\EnrollmentFeeController;
use App\Http\Controllers\Api\InstructionLanguageController;
use App\Http\Controllers\Api\MeetingTypeController;
use App\Http\Controllers\Api\PaymentTransactionController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StudentBalanceController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\EnrollmentStatusController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\AuthController;
use App\Models\InstructionLanguage;

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
Route::group(['middleware'=>['json.response']], function() {
    Route::get('sample-route', [SampleController::class, 'sampleRoute']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::apiResource('enrollment-fees', EnrollmentFeeController::class);
    Route::apiResource('colleges', CollegeController::class);
    Route::apiResource('programs', ProgramController::class);
    Route::apiResource('enrollment-status', EnrollmentStatusController::class);
    Route::apiResource('address', AddressController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('instruction-language', InstructionLanguageController::class);
    Route::apiResource('meeting-type', MeetingTypeController::class);
    Route::apiResource('student-balance', StudentBalanceController::class);
    Route::apiResource('payment-transaction', PaymentTransactionController::class);
    Route::apiResource('student', StudentController::class);
    Route::apiResource('block', BlockController::class);
});

/*
 * Protected API endpoints go here
 */
Route::group(['middleware'=>['json.response','api.auth']], function () {
    Route::get('sample-route', [SampleController::class, 'sampleRoute']);
    Route::group(['middleware'=>['api.auth:admin']], function() {
        //admin usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:college_admin']], function() {
        //college admin usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:department_admin']], function() {
        //department admin usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:program_admin']], function() {
        //program admin usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:faculty']], function() {
        //faculty usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:cashier']], function() {
        //cashier usable endpoints here
    });
    Route::group(['middleware'=>['api.auth:student']], function() {
        //student usable endpoints here
    });
});
