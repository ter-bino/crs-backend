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
            } else if($request->is('api/enrollment-status/*')) {
                return response()->json([
                    'message' => 'Enrollment status not found',
                ], 404);
            } else if($request->is('api/address/*')) {
                return response()->json([
                    'message' => 'Address not found',
                ], 404);
            } else if($request->is('api/role/*')) {
                return response()->json([
                    'message' => 'Role not found',
                ], 404);
            } else if($request->is('api/instruction-language/*')) {
                return response()->json([
                    'message' => 'Instruction language not found',
                ], 404);
            } else if($request->is('api/meeting-type/*')) {
                return response()->json([
                    'message' => 'Meeting Type not found',
                ], 404);
            } else if($request->is('api/student-balance/*')) {
                return response()->json([
                    'message' => 'Student balance not found',
                ], 404);
            } else if($request->is('api/payment-transaction/*')) {
                return response()->json([
                    'message' => 'Payment Transaction not found',
                ], 404);
            } else if($request->is('api/student/*')) {
                return response()->json([
                    'message' => 'Student not found',
                ], 404);
            } else if($request->is('api/block/*')) {
                return response()->json([
                    'message' => 'Block not found',
                ], 404);
            } else if($request->is('api/staff/*')) {
                return response()->json([
                    'message' => 'Staff not found',
                ], 404);
            } else if($request->is('api/department/*')) {
                return response()->json([
                    'message' => 'Department not found',
                ], 404);
            } else if($request->is('api/instructor/*')) {
                return response()->json([
                    'message' => 'Instructor not found',
                ], 404);
            } else if($request->is('api/teaching-assignment/*')) {
                return response()->json([
                    'message' => 'Teaching assignment not found',
                ], 404);
            } else if($request->is('api/class/*')) {
                return response()->json([
                    'message' => 'Class not found',
                ], 404);
            } else if($request->is('api/schedule/*')) {
                return response()->json([
                    'message' => 'Schedule not found',
                ], 404);
            } else if($request->is('api/room/*')) {
                return response()->json([
                    'message' => 'Room not found',
                ], 404);
            } 
        });
    }
}
