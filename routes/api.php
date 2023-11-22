<?php

use App\Http\Controllers\Api\UserAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\AddDropRequestController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\LoadTypeController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\SubActivityController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\ConsultationHourController;
use App\Http\Controllers\Api\EnrollmentFeeController;
use App\Http\Controllers\Api\EnrollmentStatusController;
use App\Http\Controllers\Api\InstructionLanguageController;
use App\Http\Controllers\Api\MeetingTypeController;
use App\Http\Controllers\Api\PaymentTransactionController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StudentBalanceController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeachingAssignmentController;

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
});

/*
 * Protected API endpoints go here
 */
Route::group(['middleware'=>['json.response','api.auth']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::apiResource('enrollment-fees', EnrollmentFeeController::class);
    Route::apiResource('colleges', CollegeController::class);
    Route::apiResource('programs', ProgramController::class);
    Route::apiResource('enrollment-statuses', EnrollmentStatusController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('instruction-languages', InstructionLanguageController::class);
    Route::apiResource('meeting-types', MeetingTypeController::class);
    Route::apiResource('student-balances', StudentBalanceController::class);
    Route::apiResource('payment-transactions', PaymentTransactionController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('blocks', BlockController::class);
    Route::apiResource('staffs', StaffController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('instructors', InstructorController::class);
    Route::apiResource('teaching-assignments', TeachingAssignmentController::class);
    Route::apiResource('classes', ClassController::class);
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('consultation-hours', ConsultationHourController::class);
    Route::apiResource('load-types', LoadTypeController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('buildings', BuildingController::class);
    Route::apiResource('activity-types', ActivityTypeController::class);
    Route::apiResource('sub-activities', SubActivityController::class);
    Route::apiResource('add-drop-requests', AddDropRequestController::class);
    Route::apiResource('user-accounts', UserAccountController::class);

    Route::group(['middleware'=>['api.auth:admin']], function() {
        //admin usable endpoints here
    });

    Route::group(['middleware'=>['api.auth:faculty']], function() {
        //faculty admin usable endpoints here
    });

    Route::group(['middleware'=>['api.auth:college']], function() {
        //college admin usable endpoints here
    });

    Route::group(['middleware'=>['api.auth:student_undergraduate']], function() {
        //student_undergraduate usable endpoints here
    });

    Route::group(['middleware'=>['api.auth:student_graduate']], function() {
        //student_graduate usable endpoints here
    });
    
    Route::group(['middleware'=>['api.auth:cashier']], function() {
        //cashier usable endpoints here
    });
});
