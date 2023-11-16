<?php

use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\AddDropRequestController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\ConsultationHourController;
use App\Http\Controllers\Api\EnrollmentFeeController;
use App\Http\Controllers\Api\InstructionLanguageController;
use App\Http\Controllers\Api\MeetingTypeController;
use App\Http\Controllers\Api\PaymentTransactionController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StudentBalanceController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeachingAssignmentController;
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
    Route::apiResource('block', BlockController::class);
    Route::apiResource('staff', StaffController::class);
    Route::apiResource('department', DepartmentController::class);
    Route::apiResource('instructor', InstructorController::class);
    Route::apiResource('teaching-assignment', TeachingAssignmentController::class);
    Route::apiResource('class', ClassController::class);
    Route::apiResource('schedule', ScheduleController::class);
    Route::apiResource('room', RoomController::class);
    Route::apiResource('consultation-hour', ConsultationHourController::class);
    Route::apiResource('load-type', LoadTypeController::class);
    Route::apiResource('subject', SubjectController::class);
    Route::apiResource('building', BuildingController::class);
    Route::apiResource('activity-type', ActivityTypeController::class);
    Route::apiResource('sub-activity', SubActivityController::class);
    Route::apiResource('add-drop-request', AddDropRequestController::class);
});

/*
 * Protected API endpoints go here
 */
Route::middleware('auth:api')->group(function () {
    //not working for now
});
