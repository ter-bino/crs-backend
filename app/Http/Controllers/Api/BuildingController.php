<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
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
        $buildings = Building::where(function ($query) use ($search) {
            $fillableColumns = (new Building)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('rooms')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($buildings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_name' => 'required|string',
            'building_code' => 'required|unique:building|string'
        ]);

        $building = new Building;
        $building->building_name = $request->input('building_name');
        $building->building_code = $request->input('building_code');
        $building->save();

        return response()->json($building, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        if ($building) {
            return response()->json($building);
        } else {
            return response()->json(['message' => 'Building not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        if ($building) {
            $request->validate([
                'building_name' => 'required|string',
                'building_code' => 'required|unique:building,' . $building->building_id .',building_id',
            ]);
    
            $building->update([
                'building_name' => $request->input('building_name'),
                'building_code' => $request->input('building_code')
            ]);
    
            return response()->json($building);
        } else {
            return response()->json(['message' => 'Building not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        if ($building) {
            $building->delete();
            return response()->json(['message' => 'Building deleted']);
        } else {
            return response()->json(['message' => 'Building not found'], 404);
        }
    }
}
