<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json([
            'brand' => $brand,
        ]);
    }
}
