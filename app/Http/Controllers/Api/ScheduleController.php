<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
        $schedules = Schedule::where(function ($query) use ($search) {
            $fillableColumns = (new Schedule)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:room,room_id',
            'meeting_type_id' => 'required|exists:meeting_type,meeting_type_id',
            'class_id' => 'required|exists:class,class_id',
            'day' => 'required|string',
            'start_time' => 'required|time',
            'end_time' => 'required|time'
        ]);

        $schedule = new Schedule;
        $schedule->room_id = $request->input('room_id');
        $schedule->meeting_type_id = $request->input('meeting_type_id');
        $schedule->class_id = $request->input('class_id');
        $schedule->day = $request->input('day');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        $schedule->save();

        return response()->json($schedule, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        if ($schedule) {
            return response()->json($schedule);
        } else {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule) {
            $request->validate([
                'room_id' => 'required|exists:room,room_id',
                'meeting_type_id' => 'required|exists:meeting_type,meeting_type_id',
                'class_id' => 'required|exists:class,class_id',
                'day' => 'required|string',
                'start_time' => 'required|time',
                'end_time' => 'required|time'
            ]);
    
            $schedule->update([
                'room_id' => $request->input('room_id'),
                'meeting_type_id' => $request->input('meeting_type_id'),
                'class_id' => $request->input('class_id'),
                'day' => $request->input('day'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time')
            ]);
    
            return response()->json($schedule);
        } else {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule) {
            $schedule->delete();
            return response()->json(['message' => 'Schedule deleted']);
        } else {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    }
}
