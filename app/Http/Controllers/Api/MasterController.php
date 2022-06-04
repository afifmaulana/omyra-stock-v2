<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function getMaster($id)
    {
        $product = Product::find($id);
        $materials = Materials::whereHas('product', function ($query) {
            $query->where('type', 'master');
        })->where('product_id', $product->id)->get();
        return response()->json([
            'materials' => $materials,
        ]);
    }
}
