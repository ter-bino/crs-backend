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
Route::group(['middleware'=>['cors', 'json.response']], function() {
    Route::get('/sample-route', [SampleController::class, 'sampleRoute']);
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
});

/*
 * Protected API endpoints go here
 */
Route::middleware('auth:api')->group(function () {
    //not working for now
});
