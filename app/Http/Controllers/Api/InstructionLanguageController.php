<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InstructionLanguage;
use Illuminate\Http\Request;

class InstructionLanguageController extends Controller
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
        $instructionLanguages = InstructionLanguage::where(function ($query) use ($search) {
            $fillableColumns = (new InstructionLanguage)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->with('class')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($instructionLanguages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|unique:instruction_language'
        ]);

        $instructionLanguage = new InstructionLanguage;
        $instructionLanguage->language = $request->input('language');
        $instructionLanguage->save();

        return response()->json($instructionLanguage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InstructionLanguage $instructionLanguage)
    {
        if ($instructionLanguage) {
            return response()->json($instructionLanguage);
        } else {
            return response()->json(['message' => 'Instruction Language not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstructionLanguage $instructionLanguage)
    {
        if ($instructionLanguage) {
            $request->validate([
                'language' => 'required|unique:instruction_language' . $instructionLanguage->instruction_language_id .',instruction_language_id', // Validate uniqueness, but ignore the current data
            ]);
    
            $instructionLanguage->update([
                'language' => $request->input('language')
            ]);
    
            return response()->json($instructionLanguage);
        } else {
            return response()->json(['message' => 'Instruction Language not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstructionLanguage $instructionLanguage)
    {
        if ($instructionLanguage) {
            $instructionLanguage->delete();
            return response()->json(['message' => 'Instruction Language deleted']);
        } else {
            return response()->json(['message' => 'Instruction Language not found'], 404);
        }
    }
}
