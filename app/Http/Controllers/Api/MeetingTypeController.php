<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MeetingType;
use Illuminate\Http\Request;

class MeetingTypeController extends Controller
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
        $meetingTypes = MeetingType::where(function ($query) use ($search) {
            $fillableColumns = (new MeetingType)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($meetingTypes);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'meeting_type_code' => 'required|unique:meeting_type',
            'label' => 'required|string',
            'active_status' => 'boolean'
        ]);
        
        $meetingType = new MeetingType;
        $meetingType->meeting_type_code = $request->input('meeting_type_code');
        $meetingType->label = $request->input('label');
        $meetingType->active_status = $request->input('active_status', false);
        $meetingType->save();

        return response()->json($meetingType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingType $meetingType)
    {
        if ($meetingType) {
            return response()->json($meetingType);
        } else {
            return response()->json(['message' => 'Meeting type not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeetingType $meetingType)
    {
        if ($meetingType) {
            $request->validate([
                'meeting_type_code' => 'required|unique:meeting_type',
                'label' => 'required|string',
                'active_status' => 'boolean'
            ]);
    
            $meetingType->update([
                'meeting_type_code' => $request->input('meeting_type_code'),
                'label' => $request->input('label'),
                'active_status' => $request->input('active_status', $meetingType->active_status)
            ]);
    
            return response()->json($meetingType);
        } else {
            return response()->json(['message' => 'Meeting Type not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingType $meetingType)
    {
        if ($meetingType) {
            $meetingType->delete();
            return response()->json(['message' => 'Meeting type deleted']);
        } else {
            return response()->json(['message' => 'Meeting type not found'], 404);
        }
    }
}
