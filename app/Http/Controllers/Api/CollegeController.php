<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * accessed via GET /api/colleges
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query

        /* Search through the fillable columns for the 'search' parameter */
        $colleges = College::where(function ($query) use ($search) {
            $fillableColumns = (new College)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('student_term', 'program')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($colleges);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * accessed via POST /api/colleges
     */
    public function store(Request $request)
    {
        $request->validate([
            'college_code' => 'required|unique:college',
            'college_title' => 'required|unique:college',
            'num_terms' => 'required|integer',
            'active_status' => 'boolean',
        ]);

        $college = new College;
        $college->college_code = $request->input('college_code');
        $college->college_title = $request->input('college_title');
        $college->num_terms = $request->input('num_terms');
        $college->active_status = $request->input('active_status', false); // Default to false if not provided
        $college->save();

        return response()->json($college, 201); // Respond with the newly created college and a 201 status code.
    }

    /**
     * Display the specified resource.
     * 
     * accessed via GET /api/colleges/{id}
     */
    public function show(College $college)
    {
        if ($college) {
            return response()->json($college);
        } else {
            return response()->json(['message' => 'College not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * accessed via PUT /api/colleges/{id}
     */
    public function update(Request $request, College $college)
    {

        if ($college) {
            $request->validate([
                'college_code' => 'required|unique:college,college_code,' . $college->college_id .',college_id', // Validate uniqueness, but ignore the current college code
                'college_title' => 'required|unique:college,college_title,' . $college->college_id .',college_id', // Validate uniqueness, but ignore the current college title
                'num_terms' => 'required|integer',
                'active_status' => 'boolean',
            ]);
    
            $college->update([
                'college_code' => $request->input('college_code'),
                'college_title' => $request->input('college_title'),
                'num_terms' => $request->input('num_terms'),
                'active_status' => $request->input('active_status', $college->active_status), // Default to false if not provided
            ]);
    
            return response()->json($college);
        } else {
            return response()->json(['message' => 'College not found'], 404);
        }
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        if ($college) {
            $college->delete();
            return response()->json(['message' => 'College deleted']);
        } else {
            return response()->json(['message' => 'College not found'], 404);
        }
    }
}