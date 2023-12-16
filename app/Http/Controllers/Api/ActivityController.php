<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityController extends Controller
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
        $activityTypes = Activity::where(function ($query) use ($search) {
            $fillableColumns = (new Activity())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($activityTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_type_id' => 'required|integer|exists:activity_type,activity_type_id',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'start_date' => 'required|date|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);
        
        $activityType = ActivityType::find($request->input('activity_type_id'));

        $activity = new Activity;
        $activity->activity_type->associate($activityType);
        $activity->academic_year = $request->input('academic_year');
        $activity->term = $request->input('term');
        $activity->start_date = $request->input('start_date');
        $activity->end_date = $request->input('end_date');
        $activity->save();
        
        return response()->json($activity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        if ($activity) {
            return response()->json($activity);
        } else {
            return response()->json(['message' => 'Activity not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        if ($activity) {
            $request->validate([
                'activity_type_id' => 'required|integer|exists:activity_type,activity_type_id',
                'academic_year' => 'required|string',
                'term' => 'required|integer',
                'start_date' => 'required|date|date_format:Y-m-d H:i:s',
                'end_date' => 'required|date|date_format:Y-m-d H:i:s',
            ]);
            
            $activityType = ActivityType::find($request->input('activity_type_id'));

            $activity->activity_type->associate($activityType);
            $activity->academic_year = $request->input('academic_year');
            $activity->term = $request->input('term');
            $activity->start_date = $request->input('start_date');
            $activity->end_date = $request->input('end_date');
            $activity->save();
            
            return response()->json($activity);
        } else {
            return response()->json(['message' => 'Activity not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        if ($activity) {
            $activity->delete();
            return response()->json(['message' => 'Activity deleted']);
        } else {
            return response()->json(['message' => 'Activity not found'], 404);
        }
    }
}
