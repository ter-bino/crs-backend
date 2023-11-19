<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if($request->is('api/colleges/*')) {
                return response()->json([
                    'message' => 'College not found',
                ], 404);
            } else if($request->is('api/enrollment-fees/*')) {
                return response()->json([
                    'message' => 'Enrollment fee not found',
                ], 404);
            } else if($request->is('api/programs/*')) {
                return response()->json([
                    'message' => 'Program not found',
                ], 404);
            } else if($request->is('api/enrollment-statuses/*')) {
                return response()->json([
                    'message' => 'Enrollment status not found',
                ], 404);
            } else if($request->is('api/addresses/*')) {
                return response()->json([
                    'message' => 'Address not found',
                ], 404);
            } else if($request->is('api/roles/*')) {
                return response()->json([
                    'message' => 'Role not found',
                ], 404);
            } else if($request->is('api/instruction-languages/*')) {
                return response()->json([
                    'message' => 'Instruction language not found',
                ], 404);
            } else if($request->is('api/meeting-types/*')) {
                return response()->json([
                    'message' => 'Meeting Type not found',
                ], 404);
            } else if($request->is('api/student-balances/*')) {
                return response()->json([
                    'message' => 'Student balance not found',
                ], 404);
            } else if($request->is('api/payment-transactions/*')) {
                return response()->json([
                    'message' => 'Payment Transaction not found',
                ], 404);
            } else if($request->is('api/students/*')) {
                return response()->json([
                    'message' => 'Student not found',
                ], 404);
            } else if($request->is('api/blocks/*')) {
                return response()->json([
                    'message' => 'Block not found',
                ], 404);
            } else if($request->is('api/staffs/*')) {
                return response()->json([
                    'message' => 'Staff not found',
                ], 404);
            } else if($request->is('api/departments/*')) {
                return response()->json([
                    'message' => 'Department not found',
                ], 404);
            } else if($request->is('api/instructors/*')) {
                return response()->json([
                    'message' => 'Instructor not found',
                ], 404);
            } else if($request->is('api/teaching-assignments/*')) {
                return response()->json([
                    'message' => 'Teaching assignment not found',
                ], 404);
            } else if($request->is('api/classes/*')) {
                return response()->json([
                    'message' => 'Class not found',
                ], 404);
            } else if($request->is('api/schedules/*')) {
                return response()->json([
                    'message' => 'Schedule not found',
                ], 404);
            } else if($request->is('api/rooms/*')) {
                return response()->json([
                    'message' => 'Room not found',
                ], 404);
            } else if($request->is('api/consultation-hours/*')) {
                return response()->json([
                    'message' => 'Consultation Hour not found',
                ], 404);
            } else if($request->is('api/load-types/*')) {
                return response()->json([
                    'message' => 'Load Type not found',
                ], 404);
            } else if($request->is('api/subjects/*')) {
                return response()->json([
                    'message' => 'Subject not found',
                ], 404);
            } else if($request->is('api/buildings/*')) {
                return response()->json([
                    'message' => 'Building not found',
                ], 404);
            } else if($request->is('api/activity-types/*')) {
                return response()->json([
                    'message' => 'Activity Type not found',
                ], 404);
            } else if($request->is('api/sub-activities/*')) {
                return response()->json([
                    'message' => 'Sub Activity not found',
                ], 404);
            } else if($request->is('api/add-drop-requests/*')) {
                return response()->json([
                    'message' => 'Add Drop Request not found',
                ], 404);
            } else if($request->is('api/user-accounts/*')) {
                return response()->json([
                    'message' => 'User Account not found',
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Resource not found',
                ], 404);
            }
        });
    }
}
