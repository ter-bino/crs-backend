<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use Illuminate\Http\Request;

class TeachingAssignmentController extends Controller
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
        $teachingAssignments = TeachingAssignment::where(function ($query) use ($search) {
            $fillableColumns = (new TeachingAssignment())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($teachingAssignments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|exists:instructor,instructor_id|string',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'start_date' => 'required',
        ]);

        $teachingAssignment = new TeachingAssignment;
        $teachingAssignment->instructor_id = $request->input('instructor_id');
        $teachingAssignment->academic_year = $request->input('academic_year');
        $teachingAssignment->term = $request->input('term');
        $teachingAssignment->start_date = $request->input('start_date');
        $teachingAssignment->save();

        return response()->json($teachingAssignment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TeachingAssignment $teachingAssignment)
    {
        if ($teachingAssignment) {
            return response()->json($teachingAssignment);
        } else {
            return response()->json(['message' => 'Teaching Assignment not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeachingAssignment $teachingAssignment)
    {
        if ($teachingAssignment) {
            $request->validate([
                'instructor_id' => 'required|exists:instructor,instructor_id|string',
                'academic_year' => 'required|string',
                'term' => 'required|integer',
                'start_date' => 'required',
            ]);
    
            $teachingAssignment->update([
                'instructor_id' => $request->input('instructor_id'),
                'academic_year' => $request->input('academic_year'),
                'term' => $request->input('term'),
                'start_date' => $request->input('start_date'),
            ]);
    
            return response()->json($teachingAssignment);
        } else {
            return response()->json(['message' => 'Teaching Assignment not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeachingAssignment $teachingAssignment)
    {
        if ($teachingAssignment) {
            $teachingAssignment->delete();
            return response()->json(['message' => 'Teaching Assignment deleted']);
        } else {
            return response()->json(['message' => 'Teaching Assignment not found'], 404);
        }
    }
}
