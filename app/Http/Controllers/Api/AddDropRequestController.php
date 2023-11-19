<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AddDropRequest;
use Illuminate\Http\Request;

class AddDropRequestController extends Controller
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
        $addDropRequests = AddDropRequest::where(function ($query) use ($search) {
            $fillableColumns = (new AddDropRequest())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($addDropRequests);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student,student_id|integer',
            'approved_by' => 'required|exists:staff,staff_id|integer',
            'request_date' => 'required|date',
            'total_units' => 'required|integer',
            'reason' => 'required|string',
            'status' => 'required|string',
            'approved_date' => 'date'
        ]);

        $addDropRequest = new AddDropRequest;
        $addDropRequest->student_id = $request->input('student_id');
        $addDropRequest->approved_by = $request->input('approved_by');
        $addDropRequest->request_date = $request->input('request_date');
        $addDropRequest->total_units = $request->input('total_units');
        $addDropRequest->reason = $request->input('reason');
        $addDropRequest->status = $request->input('status');
        $addDropRequest->approved_date = $request->input('approved_date');
        $addDropRequest->save();

        return response()->json($addDropRequest, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AddDropRequest $addDropRequest)
    {
        if ($addDropRequest) {
            return response()->json($addDropRequest);
        } else {
            return response()->json(['message' => 'Add Drop Request not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AddDropRequest $addDropRequest)
    {
        if ($addDropRequest) {
            $request->validate([
                'student_id' => 'required|exists:student,student_id|integer',
                'approved_by' => 'required|exists:staff,staff_id|integer',
                'request_date' => 'required|date',
                'total_units' => 'required|integer',
                'reason' => 'required|string',
                'status' => 'required|string',
                'approved_date' => 'date'
            ]);
    
            $addDropRequest->update([
                'student_id' => $request->input('student_id'),
                'approved_by' => $request->input('approved_by'),
                'request_date' => $request->input('request_date'),
                'total_units' => $request->input('total_units'),
                'reason' => $request->input('reason'),
                'status' => $request->input('status'),
                'approved_date' => $request->input('approved_date')
            ]);
    
            return response()->json($addDropRequest);
        } else {
            return response()->json(['message' => 'Add Drop Request not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddDropRequest $addDropRequest)
    {
        if ($addDropRequest) {
            $addDropRequest->delete();
            return response()->json(['message' => 'Add Drop Request deleted']);
        } else {
            return response()->json(['message' => 'Add Drop Request not found'], 404);
        }
    }
}
