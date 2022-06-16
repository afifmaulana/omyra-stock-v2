<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportMasterController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.master', [
            'products' => $products,
        ]);
    }
    public function data(Request $request)
    {

		$materialId = $request->material;
		$productId = $request->product;

		$query = Stock::query();
        $query->whereRelation('material', 'type', 'master');
		$query->when($materialId , function($q) use($materialId){
			$q->where('material_id', $materialId);
		});
		$query->when($productId , function($q) use($productId){
			$q->whereRelation('material', 'product_id', $productId);
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
