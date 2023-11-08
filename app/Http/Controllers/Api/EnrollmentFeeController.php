<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentFee;
use Illuminate\Http\Request;

class EnrollmentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $search = $request->input('search', '');


        /* Search through the fillable columns for the 'search' parameter */
        $enrollmentFees = EnrollmentFee::where(function ($query) use ($search) {
            $fillableColumns = (new EnrollmentFee)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($enrollmentFees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'enrollment_fee_type' => 'required|string',
            'enrollment_fee_name' => 'required|string',
            'cost' => 'required|numeric',
        ]);

        $enrollmentFee = new EnrollmentFee;
        $enrollmentFee->enrollment_fee_type = $request->input('enrollment_fee_type');
        $enrollmentFee->enrollment_fee_name = $request->input('enrollment_fee_name');
        $enrollmentFee->cost = $request->input('cost');
        $enrollmentFee->save();

        return response()->json($enrollmentFee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EnrollmentFee $enrollmentFee)
    {
        if($enrollmentFee) {
            return response()->json($enrollmentFee);
        } else {
            return response()->json([
                'message' => 'Enrollment fee not found.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnrollmentFee $enrollmentFee)
    {
        if($enrollmentFee) {
            $request->validate([
                'enrollment_fee_type' => 'required|string',
                'enrollment_fee_name' => 'required|string',
                'cost' => 'required|numeric',
            ]);

            $enrollmentFee->update([
                'enrollment_fee_type' => $request->input('enrollment_fee_type'),
                'enrollment_fee_name' => $request->input('enrollment_fee_name'),
                'cost' => $request->input('cost'),
            ]);

            return response()->json($enrollmentFee);
        } else {
            return response()->json([
                'message' => 'Enrollment fee not found.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnrollmentFee $enrollmentFee)
    {
        if($enrollmentFee) {
            $enrollmentFee->delete();
            return response()->json(['message' => 'Enrollment fee deleted.']);
        } else {
            return response()->json([
                'message' => 'Enrollment fee not found.'
            ], 404);
        }
    }
}
