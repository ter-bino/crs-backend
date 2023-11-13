<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnrollmentStatus;
class EnrollmentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query

        /* Search through the fillable columns for the 'search' parameter */
        $enrollmentStatuses = EnrollmentStatus::where(function ($query) use ($search) {
            $fillableColumns = (new EnrollmentStatus())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($enrollmentStatuses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'enrollment_status_name' => 'required|string'
        ]);

        $enrollmentStatus = new EnrollmentStatus;
        $enrollmentStatus->enrollment_status_name = $request->input('enrollment_status_name');
        $enrollmentStatus->save();

        return response()->json($enrollmentStatus, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EnrollmentStatus $enrollmentStatus)
    {
        if ($enrollmentStatus) {
            return response()->json($enrollmentStatus);
        } else {
            return response()->json(['message' => 'Enrollment Status not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnrollmentStatus $enrollmentStatus)
    {
        if ($enrollmentStatus) {
            $request->validate([
                'enrollment_status_name' => 'required|string'
            ]);
    
            $enrollmentStatus->update([
                'enrollment_status_name' => $request->input('enrolllment_status_name'),
            ]);
    
            return response()->json($enrollmentStatus);
        } else {
            return response()->json(['message' => 'College not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnrollmentStatus $enrollmentStatus)
    {
        if ($enrollmentStatus) {
            $enrollmentStatus->delete();
            return response()->json(['message' => 'Enrollment Status deleted']);
        } else {
            return response()->json(['message' => 'Enrollment Status not found'], 404);
        }
    }
}
