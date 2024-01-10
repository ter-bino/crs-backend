<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentBalance;
use Illuminate\Http\Request;

class StudentBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query
        $includeStudentInfo = $request->input('student_info', false); // Check if 'student_info' parameter is set to true

        /* Search through the fillable columns for the 'search' parameter */
        $studentBalances = StudentBalance::where(function ($query) use ($search) {
            $fillableColumns = (new StudentBalance)->getFillable();
    
            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('student', 'payment_transactions', 'enrollment_fees')
        ->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json($studentBalances);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student,student_id|integer',
            'terms_of_payment' => 'required|string',
            'assessment_type' => 'required|string',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'overall_paid' => 'required|numeric',
            'overall_balance' => 'required|numeric',
        ]);

        $studentBalance = new StudentBalance;
        $studentBalance->student_id = $request->input('student_id');
        $studentBalance->terms_of_payment = $request->input('terms_of_payment');
        $studentBalance->assessment_type = $request->input('assessment_type');
        $studentBalance->academic_year = $request->input('academic_year');
        $studentBalance->term = $request->input('term');
        $studentBalance->total_amount = $request->input('total_amount');
        $studentBalance->paid_amount = $request->input('paid_amount');
        $studentBalance->overall_paid = $request->input('overall_paid');
        $studentBalance->overall_balance = $request->input('overall_balance');
        $studentBalance->save();

        return response()->json($studentBalance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentBalance $studentBalance)
    {
        if ($studentBalance) {
            return response()->json($studentBalance);
        } else {
            return response()->json(['message' => 'Student Balance not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentBalance $studentBalance)
    {
        if ($studentBalance) {
            $request->validate([
            'student_id' => 'required|exists:student,student_id|integer',
            'terms_of_payment' => 'required|sring',
            'assessment_type' => 'required|string',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'overall_paid' => 'required|numeric',
            'overall_balance' => 'required|numeric',
        ]);

    
            $studentBalance->update([
                'terms_of_payment' => $request->input('terms_of_payment'),
                'assessment_type' => $request->input('assessment_type'),
                'academic_year' => $request->input('academic_year'),
                'term' => $request->input('term'),
                'total_amount' => $request->input('total_amount'),
                'paid_amount' => $request->input('paid_amount'),
                'overall_paid' => $request->input('overall_paid'),
                'overall_balance' => $request->input('overall_balance'),
            ]);
    
            return response()->json($studentBalance);
        } else {
            return response()->json(['message' => 'Student Balance not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentBalance $studentBalance)
    {
        if ($studentBalance) {
            $studentBalance->delete();
            return response()->json(['message' => 'Student Balance deleted']);
        } else {
            return response()->json(['message' => 'Student Balance not found'], 404);
        }
    }
}
