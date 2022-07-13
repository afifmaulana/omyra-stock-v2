<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Semifinish;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportSemifinishController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.semifinish', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }
    public function data(Request $request)
    {

		$materialId = $request->material;
		$productId = $request->product;
        $brandId = $request->brand;

		$query = Semifinish::query();
        $query->whereRelation('material', 'type', 'plastic');
		$query->when($materialId , function($q) use($materialId){
			$q->where('material_id', $materialId);
		});
		$query->when($productId , function($q) use($productId){
			$q->whereRelation('material', 'product_id', $productId);
		});
        $query->when($brandId , function($q) use($brandId){
			$q->whereRelation('material.product', 'brand_id', $brandId);
		});
		$query->with('material:id,product_id,name,stock');
		$query->with('material.product:id,brand_id,size');
		$query->with('material.product.brand:id,name');
        // $query->with('material.recordsemifinishes');
		// $query->with('material.recordsemifinishes.material');
		// $query->with('material.recordsemifinishes.product');
		// $query->with('material.recordsemifinishes.brand');


        $query->with('product.recordsemifinishes');
		$query->with('product.recordsemifinishes.material');
		$query->with('product.recordsemifinishes.product');
		$query->with('product.recordsemifinishes.brand');

        // $query->with('records');
        // $query->with('records.material');
        // $query->with('records.product');
        // $query->with('records.brand');

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
