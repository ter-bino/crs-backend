<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsultationHour;
use Illuminate\Http\Request;

class ConsultationHourController extends Controller
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
        $consultationHours = ConsultationHour::where(function ($query) use ($search) {
            $fillableColumns = (new ConsultationHour())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('teaching_assignment')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($consultationHours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teaching_assignment_id' => 'required|exists:teaching_assignment,teaching_assignment_id',
            'day' => 'required|string',
            'start_time' => 'required|time',
            'end_time' => 'required|time',
        ]);

        $consultationHour = new ConsultationHour;
        $consultationHour->teaching_assignment_id = $request->input('teaching_assignment_id');
        $consultationHour->day = $request->input('day');
        $consultationHour->start_time = $request->input('start_time');
        $consultationHour->end_time = $request->input('end_time');
        $consultationHour->save();

        return response()->json($consultationHour, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationHour $consultationHour)
    {
        if ($consultationHour) {
            return response()->json($consultationHour);
        } else {
            return response()->json(['message' => 'Consultation Hour not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsultationHour $consultationHour)
    {
        if ($consultationHour) {
            $request->validate([
                'teaching_assignment_id' => 'required|exists:teaching_assignment,teaching_assignment_id',
                'day' => 'required|string',
                'start_time' => 'required|time',
                'end_time' => 'required|time',
            ]);
    
            $consultationHour->update([
                'teaching_assignment_id' => $request->input('teaching_assignment_id'),
                'day' => $request->input('day'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);
    
            return response()->json($consultationHour);
        } else {
            return response()->json(['message' => 'Consultation Hour not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationHour $consultationHour)
    {
        if ($consultationHour) {
            $consultationHour->delete();
            return response()->json(['message' => 'Consultation Hour deleted']);
        } else {
            return response()->json(['message' => 'Consultation Hour not found'], 404);
        }
    }
}
