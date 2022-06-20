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
        $brands = Brand::orderBy('name', 'ASC')->get();
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
        $query->whereRelation('master', 'type', 'master');
		$query->when($materialId , function($q) use($materialId){
			$q->where('master_id', $materialId);
		});
		$query->when($productId , function($q) use($productId){
			$q->where('product_id', $productId);
		});
        $query->when($brandId , function($q) use($brandId){
			$q->whereRelation('master.product', 'brand_id', $brandId);
		});
		$query->with('master:id,product_id,name,stock');
		$query->with('master.product:id,brand_id,size');
		$query->with('master.product.brand:id,name');

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
