<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles = Role::where(function ($query) use ($search) {
            $fillableColumns = (new Role)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string'
        ]);

        $role = new Role;
        $role->role_name = $request->input('role_name');
        $role->save();

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if ($role) {
            return response()->json($role);
        } else {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if ($role) {
            $request->validate([
                'role_name' => 'required|string'
            ]);
    
            $role->update([
                'role_name' => $request->input('role_name')
            ]);
    
            return response()->json($role);
        } else {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role) {
            $role->delete();
            return response()->json(['message' => 'Role deleted']);
        } else {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }
}
