<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
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
        $activityTypes = ActivityType::where(function ($query) use ($search) {
            $fillableColumns = (new ActivityType())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('activities')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($activityTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_type_name' => 'required|string'
        ]);

        $activityType = new ActivityType;
        $activityType->activity_type_name = $request->input('activity_type_name');
        $activityType->save();

        return response()->json($activityType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityType $activityType)
    {
        if ($activityType) {
            return response()->json($activityType);
        } else {
            return response()->json(['message' => 'Activity Type not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityType $activityType)
    {
        if ($activityType) {
            $request->validate([
                'activity_type_name' => 'required|string'
            ]);
    
            $activityType->update([
                'activity_type_name' => $request->input('activity_type_name'),
            ]);
    
            return response()->json($activityType);
        } else {
            return response()->json(['message' => 'Activity Type not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityType $activityType)
    {
        if ($activityType) {
            $activityType->delete();
            return response()->json(['message' => 'Activity Type deleted']);
        } else {
            return response()->json(['message' => 'Activity Type not found'], 404);
        }
    }
}
