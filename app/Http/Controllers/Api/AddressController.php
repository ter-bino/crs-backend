<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
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
        $addresses = Address::where(function ($query) use ($search) {
            $fillableColumns = (new Address)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($addresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'street_address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zip_code' => 'required|string',
            'telephone_no' => 'required|string'
        ]);

        $address = new Address;
        $address->street_address = $request->input('street_address');
        $address->city = $request->input('city');
        $address->province = $request->input('province');
        $address->zip_code = $request->input('zip_code');
        $address->telephone_no = $request->input('telephone_no');
        $address->save();

        return response()->json($address, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(['message' => 'Address not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        if ($address) {
            $request->validate([
                'street_address' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'zip_code' => 'required|string',
                'telephone_no' => 'required|string'
            ]);
    
            $address->update([
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'zip_code' => $request->input('zip_code'),
                'telephone_no' => $request->input('telephone_no')
            ]);
    
            return response()->json($address);
        } else {
            return response()->json(['message' => 'Address not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        if ($address) {
            $address->delete();
            return response()->json(['message' => 'Address deleted']);
        } else {
            return response()->json(['message' => 'Address not found'], 404);
        }
    }
}
