<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
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
        $paymentTransactions = PaymentTransaction::where(function ($query) use ($search) {
            $fillableColumns = (new PaymentTransaction())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('student_balance')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($paymentTransactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_balance_id' => 'required|exists:student_balance,student_balance_id|integer',
            'payment_order' => 'required|string',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'amount' => 'required|numeric',
            'excess_amount' => 'required|numeric',
            'or_number' => 'required|string',
            'code' => 'required|string',
            'remark' => 'required|string',
            'time' => 'required',
            'date' => 'required|date'
        ]);

        $paymentTransaction = new PaymentTransaction;
        $paymentTransaction->student_balance_id = $request->input('student_balance_id');
        $paymentTransaction->payment_order = $request->input('payment_order');
        $paymentTransaction->payment_method = $request->input('payment_method');
        $paymentTransaction->payment_status = $request->input('payment_status');
        $paymentTransaction->amount = $request->input('amount');
        $paymentTransaction->excess_amount = $request->input('excess_amount');
        $paymentTransaction->or_number = $request->input('or_number');
        $paymentTransaction->code = $request->input('code');
        $paymentTransaction->remark = $request->input('remark');
        $paymentTransaction->time = $request->input('time');
        $paymentTransaction->date = $request->input('date');
        $paymentTransaction->save();

        return response()->json($paymentTransaction, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentTransaction $paymentTransaction)
    {
        if ($paymentTransaction) {
            return response()->json($paymentTransaction);
        } else {
            return response()->json(['message' => 'Payment Transaction not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentTransaction $paymentTransaction)
    {
        if ($paymentTransaction) {
            $request->validate([
                'student_balance_id' => 'required|exists:student_balance,student_balance_id|integer',
                'payment_order' => 'required|string',
                'payment_method' => 'required|string',
                'payment_status' => 'required|string',
                'amount' => 'required|numeric',
                'excess_amount' => 'required|numeric',
                'or_number' => 'required|string',
                'code' => 'required|string',
                'remark' => 'required|string',
                'time' => 'required',
                'date' => 'required|date'
            ]);
    
            $paymentTransaction->update([
                'student_balance_id' => $request->input('student_balance_id'),
                'payment_method' => $request->input('payment_method'),
                'payment_status' => $request->input('payment_status'),
                'amount' => $request->input('amount'),
                'excess_amount' => $request->input('excess_amount'),
                'or_number' => $request->input('or_number'),
                'code' => $request->input('code'),
                'remark' => $request->input('remark'),
                'time' => $request->input('time'),
                'date' => $request->input('date'),
            ]);
    
            return response()->json($paymentTransaction);
        } else {
            return response()->json(['message' => 'Payment Transaction not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentTransaction $paymentTransaction)
    {
        if ($paymentTransaction) {
            $paymentTransaction->delete();
            return response()->json(['message' => 'Payment Transaction deleted']);
        } else {
            return response()->json(['message' => 'Payment Transaction not found'], 404);
        }
    }
}
