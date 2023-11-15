<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query

        /* Search through the fillable columns for the 'search' parameter */
        $instructors = Instructor::where(function ($query) use ($search) {
            $fillableColumns = (new Instructor)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($instructors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,staff_id|integer',
            'instructor_code' => 'required|unique:instructor',
            'teaching_position' => 'required|string',
            'employment_type' => 'required|string'
        ]);

        $instructor = new Instructor;
        $instructor->staff_id = $request->input('staff_id');
        $instructor->instructor_code = $request->input('instructor_code');
        $instructor->teaching_position = $request->input('teaching_position');
        $instructor->employment_type = $request->input('employment_type');
        $instructor->save();

        return response()->json($instructor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        if ($instructor) {
            return response()->json($instructor);
        } else {
            return response()->json(['message' => 'Instructor not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        if ($instructor) {
            $request->validate([
                'staff_id' => 'required|exists:staff,staff_id,' . $instructor->instructor_id .',instructor_id',
                'instructor_code' => 'required|unique:instructor' . $instructor->instructor_id .',instructor_id',
                'teaching_position' => 'required|string',
                'employment_type' => 'required|string'
            ]);
    
            $instructor->update([
                'instructor_code' => $request->input('instructor_code'),
                'teaching_position' => $request->input('teaching_position'),
                'employment_type' => $request->input('employment_type'),
                'staff_id' => $request->input('staff_id'),
            ]);
    
            return response()->json($instructor);
        } else {
            return response()->json(['message' => 'Instructor not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        if ($instructor) {
            $instructor->delete();
            return response()->json(['message' => 'Instructor deleted']);
        } else {
            return response()->json(['message' => 'Instructor not found'], 404);
        }
    }
}
