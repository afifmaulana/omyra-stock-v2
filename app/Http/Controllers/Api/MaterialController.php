<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function show($id)
    {
        $material = Materials::find($id);
        return response()->json([
            'material' => $material,
        ]);
    }

    public function inner($id)
    {
        # code...
    }
}
