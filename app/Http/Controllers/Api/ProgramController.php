<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * accessed via GET api/programs
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query

        /* Search through the fillable columns for the 'search' parameter */
        $programs = Program::where(function ($query) use ($search) {
            $fillableColumns = (new Program)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($programs, 200);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * accessed via POST api/programs
     */
    public function store(Request $request)
    {
        $request->validate([
            'college_id' => 'required|exists:college,college_id|integer',
            'program_code' => 'required|unique:program|string',
            'program_name' => 'required|unique:program|string',
            'num_years' => 'required|integer',
            'program_type' => 'required|string',
            'active_status' => 'boolean'
        ]);

        $program = new Program;
        $program->college_id = $request->input('college_id');
        $program->program_code = $request->input('program_code');
        $program->program_name = $request->input('program_name');
        $program->num_years = $request->input('num_years');
        $program->program_type = $request->input('program_type');
        $program->active_status = $request->input('active_status', false); // Default to false if not provided
        $program->save();

        return response()->json($program, 201); // Respond with the newly created college and a 201 status code.
    }

    /**
     * Display the specified resource.
     * 
     * accessed via GET /api/programs/{id}
     */
    public function show(Program $program)
    {
        if ($program) {
            return response()->json($program, 200);
        } else {
            return response()->json(['message' => 'Program not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * accessed via PUT /api/programs/{id}
     */
    public function update(Request $request, Program $program)
    {
        if ($program) {

            $request->validate([
                'college_id' => 'required|exists:college,college_id|integer',
                'program_code' => 'required|unique:program|string' . $program->program_id .',program_id', // Validate uniqueness, but ignore the current data
                'program_name' => 'required|unique:program|string' . $program->program_id .',program_id',
                'num_years' => 'required|integer',
                'program_type' => 'required|string',
                'active_status' => 'boolean'
            ]);
    
            $program->update([
                'college_id' => $request->input('college_id', $program->college_id), //default to old value if not provided
                'program_code' => $request->input('program_code', $program->program_code), //default to old value if not provided
                'program_name' => $request->input('program_name', $program->program_name), //default to old value if not provided
                'num_years' => $request->input('num_years', $program->num_years), //default to old value if not provided
                'program_type' => $request->input('program_type', $program->program_type), //default to old value if not provided
                'active_status' => $request->input('active_status', $program->active_status), //default to old value if not provided
            ]);
    
            return response()->json($program, 200);
        } else {
            return response()->json(['message' => 'Program not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * accessed via DELETE api/programs/{id}
     */
    public function destroy(Program $program)
    {
        if ($program) {
            $program->delete();
            return response()->json(['message' => 'Program deleted'], 200);
        } else {
            return response()->json(['message' => 'Program not found'], 404);
        }
    }
}
