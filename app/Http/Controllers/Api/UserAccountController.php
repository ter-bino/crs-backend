<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
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
        $colleges = UserAccount::where(function ($query) use ($search) {
            $fillableColumns = (new UserAccount)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($colleges);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plm_email_address' => 'required|unique:user_account',
            'account_expiry_date' => 'required|date',
            'active_status' => 'boolean',
        ]);

        $userAccount = new UserAccount;
        $userAccount->plm_email_address = $request->input('plm_email_address');
        $userAccount->account_expiry_date = $request->input('account_expiry_date');
        $userAccount->active_status = $request->input('active_status', false);
        $userAccount->save();

        return response()->json($userAccount, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAccount $userAccount)
    {
        if ($userAccount) {
            return response()->json($userAccount);
        } else {
            return response()->json(['message' => 'UserAccount not found'], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAccount $userAccount)
    {
        if($userAccount) {
            $request->validate([
                'plm_email_address' => 'required|unique:user_account,plm_email_address,' . $userAccount->user_account_id . ',user_account_id',
                'account_expiry_date' => 'required|date',
                'active_status' => 'boolean',
            ]);

            $userAccount->plm_email_address = $request->input('plm_email_address');
            $userAccount->account_expiry_date = $request->input('account_expiry_date');
            $userAccount->active_status = $request->input('active_status', $userAccount->active_status);
            $userAccount->save();

            return response()->json($userAccount);
        } else {
            return response()->json(['message' => 'UserAccount not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAccount $userAccount)
    {
        if ($userAccount) {
            $userAccount->delete();
            return response()->json(['message' => 'UserAccount deleted']);
        } else {
            return response()->json(['message' => 'UserAccount not found'], 404);
        }
    }
}
