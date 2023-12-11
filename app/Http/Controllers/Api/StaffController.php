<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
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
        $staffs = Staff::where(function ($query) use ($search) {
            $fillableColumns = (new Staff)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($staffs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_account_id' => 'required|exists:user_account,user_account_id|integer',
            'address_id' => 'required|exists:address, address_id|integer',
            'employee_number' => 'required|string|unique:staff',
            'designation' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'name_extension' => 'required|string',
            'pedigree' => 'required|string',
            'sex' => 'required|string',
            'civil_status' => 'required|string',
            'citizenship' => 'required|string',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'contact_no' => 'required|string|unique:staff',
            'personal_email' => 'required|string|unique:staff',
            'TIN_no' => 'required|string|unique:staff',
            'GSIS_no' => 'required|string|unique:staff',
        ]);

        $staff = new Staff;
        $staff->user_account_id = $request->input('user_account_id');
        $staff->address_id = $request->input('address_id');
        $staff->employee_number = $request->input('employee_number');
        $staff->designation = $request->input('designation');
        $staff->first_name = $request->input('first_name');
        $staff->last_name = $request->input('last_name');
        $staff->middle_name = $request->input('middle_name');
        $staff->name_extension = $request->input('name_extension');
        $staff->pedigree = $request->input('pedigree');
        $staff->sex = $request->input('sex');
        $staff->civil_status = $request->input('civil_status');
        $staff->citizenship = $request->input('citizenship');
        $staff->birth_date = $request->input('birth_date');
        $staff->birth_place = $request->input('birth_place');
        $staff->contact_no = $request->input('contact_no');
        $staff->personal_email = $request->input('personal_email');
        $staff->TIN_no = $request->input('TIN_no');
        $staff->GSIS_no = $request->input('GSIS_no');
        $staff->save();

        return response()->json($staff, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        if ($staff) {
            return response()->json($staff);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        if ($staff) {
            $request->validate([
                'user_account_id' => 'required|exists:user_account,user_account_id|integer',
                'address_id' => 'required|exists:address, address_id|integer',
                'employee_number' => 'required|unique:employee,' . $staff->staff_id .',staff_id',
                'designation' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'middle_name' => 'required|string',
                'name_extension' => 'required|string',
                'pedigree' => 'required|string',
                'sex' => 'required|string',
                'civil_status' => 'required|string',
                'citizenship' => 'required|string',
                'birth_date' => 'required|date',
                'birth_place' => 'required|string',
                'contact_no' => 'required|unique:employee,' . $staff->staff_id .',staff_id',
                'personal_email' => 'required|unique:employee,' . $staff->staff_id .',staff_id',
                'TIN_no' => 'required|unique:employee,' . $staff->staff_id .',staff_id',
                'GSIS_no' => 'required|unique:employee,' . $staff->staff_id .',staff_id',
            ]);
    
            $staff->update([
                'user_account_id' => $request->input('user_account_id'),
                'address_id' => $request->input('address_id'),
                'employee_number' => $request->input('employee_number'),
                'designation' => $request->input('designation'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'name_extension' => $request->input('name_extension'),
                'pedigree' => $request->input('pedigree'),
                'sex' => $request->input('sex'),
                'civil_status' => $request->input('civil_status'),
                'citizenship' => $request->input('citizenship'),
                'birth_date' => $request->input('birth_date'),
                'birth_place' => $request->input('birth_place'),
                'contact_no' => $request->input('contact_no'),
                'personal_email' => $request->input('personal_email'),
                'TIN_no' => $request->input('TIN_no'),
                'GSIS_no' => $request->input('GSIS_no'),
            ]);
    
            return response()->json($staff);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        if ($staff) {
            $staff->delete();
            return response()->json(['message' => 'Staff deleted']);
        } else {
            return response()->json(['message' => 'Staff not found'], 404);
        }
    }
}
