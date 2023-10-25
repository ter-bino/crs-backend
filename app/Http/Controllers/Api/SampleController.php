<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    public function sampleRoute()
    {
        $response = [
            'data' => [
                'id' => 1,
                'description' => 'Sample Route',
            ],
            'status' => 200,
        ];
    
        return response()->json($response, 200);
    }
}
