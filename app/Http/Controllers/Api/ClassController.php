<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\M_Class;
use Illuminate\Http\Request;

class ClassController extends Controller
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
        $classes = M_Class::where(function ($query) use ($search) {
            $fillableColumns = (new M_Class)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($classes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subject,subject_id|string',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'minimum_year_level' => 'required|integer',
            'section' => 'required|integer',
            'slots' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'active_status' => 'boolean'
        ]);

        $class = new M_Class();
        $class->subject_id = $request->input('subject_id');
        $class->academic_year = $request->input('academic_year');
        $class->term = $request->input('term');
        $class->minimum_year_level = $request->input('minimum_year_level');
        $class->section = $request->input('section');
        $class->slots = $request->input('slots');
        $class->start_date = $request->input('start_date');
        $class->end_date = $request->input('end_date');
        $class->active_status = $request->input('active_status');
        $class->save();

        return response()->json($class, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(M_Class $class)
    {
        if ($class) {
            return response()->json($class);
        } else {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, M_Class $class)
    {
        if ($class) {
            $request->validate([
                'subject_id' => 'required|exists:subject,subject_id|string',
                'academic_year' => 'required|string',
                'term' => 'required|integer',
                'minimum_year_level' => 'required|integer',
                'section' => 'required|integer',
                'slots' => 'required|integer',
                'start_date' => 'required',
                'end_date' => 'required',
                'active_status' => 'boolean'
            ]);
    
            $class->update([
                'subject_id' => $request->input('subject_id'),
                'academic_year' => $request->input('academic_year'),
                'term' => $request->input('term'),
                'minimum_year_level' => $request->input('minimum_year_level'),
                'section' => $request->input('section'),
                'slots' => $request->input('slots'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'active_status' => $request->input('active_status', $class->active_status),

            ]);
    
            return response()->json($class);
        } else {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(M_Class $class)
    {
        if ($class) {
            $class->delete();
            return response()->json(['message' => 'Class deleted']);
        } else {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }
}
