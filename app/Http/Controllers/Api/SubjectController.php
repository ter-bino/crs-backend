<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
        $subjects = Subject::where(function ($query) use ($search) {
            $fillableColumns = (new Subject)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|unique:subject',
            'subject_title' => 'required|string',
            'subject_type' => 'required|string',
            'units' => 'required|integer',
            'credited_units' => 'required|integer',
            'active_status' => 'boolean'
        ]);

        $subject = new Subject;
        $subject->subject_code = $request->input('subject_code');
        $subject->subject_title = $request->input('subject_title');
        $subject->subject_type = $request->input('subject_type');
        $subject->units = $request->input('units');
        $subject->credited_units = $request->input('credited_units');
        $subject->active_status = $request->input('active_status');
        $subject->save();

        return response()->json($subject, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        if ($subject) {
            return response()->json($subject);
        } else {
            return response()->json(['message' => 'Subject not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        if ($subject) {
            $request->validate([
                'subject_code' => 'required|unique:subject,' . $subject->subject_id .',subject_id',
                'subject_title' => 'required|string',
                'subject_type' => 'required|string',
                'units' => 'required|integer',
                'credited_units' => 'required|integer',
                'active_status' => 'boolean'
            ]);
    
            $subject->update([
                'subject_code' => $request->input('subject_code'),
                'subject_title' => $request->input('subject_title'),
                'subject_type' => $request->input('subject_type'),
                'units' => $request->input('units'),
                'credited_units' => $request->input('credited_units'),
                'active_status' => $request->input('active_status')
            ]);
    
            return response()->json($subject);
        } else {
            return response()->json(['message' => 'Subject not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject) {
            $subject->delete();
            return response()->json(['message' => 'Subject deleted']);
        } else {
            return response()->json(['message' => 'Subject not found'], 404);
        }
    }
}
