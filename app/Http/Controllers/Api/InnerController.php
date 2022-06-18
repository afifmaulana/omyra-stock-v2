<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;

class InnerController extends Controller
{
    public function getProduct($id)
    {
        $brand = Brand::find($id);
        $products = Product::whereHas('brand')->where('brand_id', $brand->id)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    public function getInner($id)
    {
        $product = Product::find($id);
        $materials = Materials::whereHas('product', function ($query) {
            $query->where('type', 'inner');
        })->where('product_id', $product->id)->with('product:id,brand_id,size')->get();
        return response()->json([
            'materials' => $materials,
        ]);
    }
}
