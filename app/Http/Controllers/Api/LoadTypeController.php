<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoadType;
use Illuminate\Http\Request;

class LoadTypeController extends Controller
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
        $loadTypes = LoadType::where(function ($query) use ($search) {
            $fillableColumns = (new LoadType)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($loadTypes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'load_type_code' => 'required|unique:load_type|string',
            'load_type_name' => 'required|string'
        ]);

        $loadType = new LoadType;
        $loadType->load_type_code = $request->input('load_type_code');
        $loadType->load_type_name = $request->input('load_type_name');
        $loadType->save();

        return response()->json($loadType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LoadType $loadType)
    {
        if ($loadType) {
            return response()->json($loadType);
        } else {
            return response()->json(['message' => 'Load Type not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoadType $loadType)
    {
        if ($loadType) {
            $request->validate([
                'load_type_code' => 'required|unique:load_type,' . $loadType->load_type_id .',load_type_id',
                'load_type_name' => 'required|string'
            ]);
    
            $loadType->update([
                'load_type_code' => $request->input('load_type_code'),
                'load_type_name' => $request->input('load_type_name')
            ]);
    
            return response()->json($loadType);
        } else {
            return response()->json(['message' => 'Load Type not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoadType $loadType)
    {
        if ($loadType) {
            $loadType->delete();
            return response()->json(['message' => 'Load Type deleted']);
        } else {
            return response()->json(['message' => 'Load Type not found'], 404);
        }
    }
}
