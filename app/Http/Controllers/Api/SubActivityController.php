<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubActivity;
use Illuminate\Http\Request;

class SubActivityController extends Controller
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
        $subActivities = SubActivity::where(function ($query) use ($search) {
            $fillableColumns = (new SubActivity)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('activity')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($subActivities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activity,activity_id',
            'sub_activity_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $subActivity = new SubActivity;
        $subActivity->activity_id = $request->input('activity_id');
        $subActivity->sub_activity_name = $request->input('sub_activity_name');
        $subActivity->start_date = $request->input('start_date');
        $subActivity->end_date = $request->input('end_date');
        $subActivity->save();

        return response()->json($subActivity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubActivity $subActivity)
    {
        if ($subActivity) {
            return response()->json($subActivity);
        } else {
            return response()->json(['message' => 'Sub Activity not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubActivity $subActivity)
    {
        if ($subActivity) {
            $request->validate([
                'activity_id' => 'required|exists:activity,activity_id',
                'sub_activity_name' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date'
            ]);
    
            $subActivity->update([
                'activity_id' => $request->input('activity_id'),
                'sub_activity_name' => $request->input('sub_activity_name'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date')
            ]);
    
            return response()->json($subActivity);
        } else {
            return response()->json(['message' => 'Sub Activity not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubActivity $subActivity)
    {
        if ($subActivity) {
            $subActivity->delete();
            return response()->json(['message' => 'Sub Activity deleted']);
        } else {
            return response()->json(['message' => 'Sub Activity not found'], 404);
        }
    }
}
