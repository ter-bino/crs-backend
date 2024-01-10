<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
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
        $rooms = Room::where(function ($query) use ($search) {
            $fillableColumns = (new Room)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('building', 'schedules')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required|exists:building,building_id',
            'room_name' => 'required|string'
        ]);

        $room = new Room;
        $room->building_id = $request->input('building_id');
        $room->room_name = $request->input('room_name');
        $room->save();

        return response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        if ($room) {
            return response()->json($room);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    { 
        if ($room) {
            $request->validate([
                'building_id' => 'required|exists:building,building_id',
                'room_name' => 'required|string'
            ]);
    
            $room->update([
                'building_id' => $request->input('building_id'),
                'room_name' => $request->input('room_name')

            ]);
    
            return response()->json($room);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room) {
            $room->delete();
            return response()->json(['message' => 'Room deleted']);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }
}
