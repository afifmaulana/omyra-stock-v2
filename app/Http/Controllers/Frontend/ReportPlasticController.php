<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\RecordLog;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportPlasticController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.plastic', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }
    public function data(Request $request)
    {

		$materialId = $request->material;
		$productId = $request->product;
        $brandId = $request->brand;

		$query = Stock::query()->orderBy('id', 'DESC');
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
		// $query->with('material.semifinishes');
		// $query->with('material.semifinishes.material');
		// $query->with('material.semifinishes.product');
        $query->with('material.records');
		$query->with('material.records.material');
		$query->with('material.records.product');
		$query->with('material.records.brand');

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

    public function detail($id)
    {
        // $stock = Stock::where('id', $id)->first();
        // $records = RecordLog::whereHas('material', function ($query) use($id) {
            // $query->where('modelable_type', 'App\Models\Stock');
            // $query->where('material_id', $id);
        $records = RecordLog::whereHasMorph('modelable', [Stock::class], function ($query) use($id) {
            $query->where('id', $id);
        })->get();
        // dd($records);
        return view('ui.frontend.report.record.plastic', [
            // 'stock' => $stock,
            'records' => $records,
        ]);
    }

}

