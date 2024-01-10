<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $departments = Department::where(function ($query) use ($search) {
            $fillableColumns = (new Department)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('program', 'instructors')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id|integer',
            'department_code' => 'required|unique:department',
            'department_name' => 'required|string'
        ]);

        $department = new Department;
        $department->program_id = $request->input('program_id');
        $department->department_code = $request->input('department_code');
        $department->department_name = $request->input('department_name');
        $department->save();

        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        if ($department) {
            return response()->json($department);
        } else {
            return response()->json(['message' => 'College not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        if ($department) {
            $request->validate([
                'program_id' => 'required|exists:program,program_id|integer',
                'department_code' => 'required|unique:department,' . $department->department_id .',department_id',
                'department_name' => 'required|string'
            ]);
    
    
            $department->update([
                'program_id' => $request->input('program_id'),
                'department_code' => $request->input('department_code'),
                'department_name' => $request->input('department_name')
            ]);
    
            return response()->json($department);
        } else {
            return response()->json(['message' => 'Department not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department) {
            $department->delete();
            return response()->json(['message' => 'Department deleted']);
        } else {
            return response()->json(['message' => 'Department not found'], 404);
        }
    }
}
