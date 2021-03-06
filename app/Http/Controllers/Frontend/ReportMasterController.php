<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportMasterController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.master', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }
    public function data(Request $request)
    {

		$materialId = $request->material;
		$productId = $request->product;
        $brandId = $request->brand;

		$query = Stock::query();
        $query->whereRelation('material', 'type', 'master');
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
        $query->with('material.records');
		$query->with('material.records.material');
		$query->with('material.records.product');
		$query->with('material.records.brand');

		$data = $query->get();

        $recordsTotal = $query->count();
		$recordsFiltered = $data->count();

        $datas = [];

        if (!empty($data)) {
                foreach ($data as $row) {
                    $row['date'] = Carbon::parse($row->date)->translatedFormat('l, d F Y');
                    if($row->material){
                        foreach($row->material->records as $record){
                            $record['date'] = Carbon::parse($record->date)->translatedFormat('d F Y');
                        }
                    }

                    $datas[] = $row;
            }
        }

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $datas,
			'sql' => $query->toSql()
        ]);
    }

}
