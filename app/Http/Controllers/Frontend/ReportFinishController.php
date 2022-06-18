<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Finish;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportFinishController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.finish', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }
    public function data(Request $request)
    {

		$materialId = $request->material;
		$productId = $request->product;
        $brandId = $request->brand;

		$query = Finish::query();
        $query->whereRelation('material', 'type', 'master');
		$query->when($materialId , function($q) use($materialId){
			$q->where('material_id', $materialId);
		});
		$query->when($productId , function($q) use($productId){
			$q->whereRelation('product_id', $productId);
		});
        $query->when($brandId , function($q) use($brandId){
			$q->whereRelation('product', 'brand_id', $brandId);
		});
		$query->with('material:id,product_id,name,stock');
		$query->with('material.product:id,brand_id,size');
		$query->with('material.product.brand:id,name');

		$data = $query->get();

        $recordsTotal = $query->count();
		$recordsFiltered = $data->count();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
			'sql' => $query->toSql()
        ]);
    }

}