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
        $order_column = $request->input('order_column', 'activity_type_id'); // Specify the column to order by
        $order_dir = $request->input('order_dir', 'asc'); // Specify the ordering direction

        $fillableColumns = (new ActivityType())->getFillable();

        /* Search through the fillable columns for the 'search' parameter */
        $activityTypes = ActivityType::where(function ($query) use ($search, $fillableColumns) {
            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->when(in_array($order_column, $fillableColumns),
            function ($query) use ($order_column, $order_dir) {
                $query->orderBy($order_column, $order_dir);
            },
            function ($query) use ($order_dir) {
                $query->orderBy('activity_type_id', $order_dir);
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
