<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
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
        $blocks = Block::where(function ($query) use ($search) {
            $fillableColumns = (new Block)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($blocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id|integer',
            'academic_year' => 'required|string',
            'term' => 'required|integer',
            'section' => 'required|integer',
            'slots' => 'required|integer',
        ]);

        $block = new Block;
        $block->program_id = $request->input('program_id');
        $block->academic_year = $request->input('academic_year');
        $block->term = $request->input('term');
        $block->section = $request->input('section');
        $block->slots = $request->input('slots');
        $block->save();

        return response()->json($block, 201);        
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        if ($block) {
            return response()->json($block);
        } else {
            return response()->json(['message' => 'Block not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BLock $block)
    {
        if ($block) {
            $request->validate([
                'program_id' => 'required|exists:program,program_id|integer',
                'academic_year' => 'required|string',
                'term' => 'required|integer',
                'section' => 'required|integer',
                'slots' => 'required|integer',
            ]);
    
            $block->update([
                'program_id' => $request->input('program_id'),
                'academic_year' => $request->input('academic_year'),
                'term' => $request->input('term'),
                'section' => $request->input('section'),
                'slots' => $request->input('slots'),
            ]);
    
            return response()->json($block);
        } else {
            return response()->json(['message' => 'Block not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        if ($block) {
            $block->delete();
            return response()->json(['message' => 'Block deleted']);
        } else {
            return response()->json(['message' => 'Block not found'], 404);
        }
    }
}
