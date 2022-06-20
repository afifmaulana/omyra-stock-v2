<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;

class PlasticController extends Controller
{
    public function getPlastic($id)
    {
        // $product = Product::find($id);
        // $materials = Materials::whereHas('product', function ($query) {
        //     $query->where('type', 'plastic');
        // })->where('product_id', $product->id)->get();
        // return response()->json([
        //     'materials' => $materials,
        // ]);
        $brand = Brand::find($id);
        $query = Materials::query();
        $query->where('type', 'plastic');
        $query->whereRelation('product', 'brand_id', $brand->id);
        $query->with('product');
        $data = $query->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function getProduct($id)
    {
        $brand = Brand::find($id);
        $query = Materials::query();
        $query->where('type', 'plastic');
        $query->whereRelation('product', 'brand_id', $brand->id);
        $query->with('product');
        $data = $query->get();
        // $products = Product::whereHas('brand')
        // ->whereRelation('materials', 'type', 'plastic')
        // ->where('brand_id', $brand->id)->get();
        return response()->json([
            'data' => $data,
        ]);
    }
}
