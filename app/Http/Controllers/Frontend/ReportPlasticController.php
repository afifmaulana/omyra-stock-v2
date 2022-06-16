<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportPlasticController extends Controller
{
    public function index()
    {
        // $data ['type'] = $type;
    	$data ['PARENTTAG'] = 'stock';
    	// $data ['CHILDTAG'] = $type;
        $data ['list_product'] = Product::all();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.plastic', [
            'products' => $products,
            'data' => $data,
        ]);
    }
    public function data(Request $request)
    {
        // $type = str_replace('-', ' ', $type);
    	// $orderBy = 'stocks.date';
        // switch($request->input('order.0.column')){
        //     case "1":
        //         $orderBy = 'stocks.date';
        //         break;
        //     case "2":
        //         $orderBy = 'stocks.material_id';
        //         break;
        //     case "3":
        //         $orderBy = 'stocks.total';
        //         break;
        //     case "4":
        //         $orderBy = 'materials.name';
        //         break;
        //     case "5":
        //         $orderBy = 'brands.name';
        //         break;
        //     case "6":
        //         $orderBy = 'products.size';
        //         break;

        // }

        // $data = Stock::select([
        //     'stocks.*',
        //     // 'brands.name as brand',
        //     // 'products.size as product',
        //     'materials.name as material'

        // ])
        // ->where('status',$type)
        // ->join('brands','brands.id','=','products.brand_id')
        // ->join('products','products.id','=','materials.product_id')
        // ->join('materials','materials.id','=','stocks.material_id');



        // if($request->input('search.value')!=null){
        //     $data = $data->where(function($q)use($request){
        //         $q->whereRaw('LOWER(stocks.date) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(stocks.material_id) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(materials.name) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(products.size) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(brands.name) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(stocks.total) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ;
        //     });
        // }
        // if($request->input('brand')!=null){
        //     $data = $data->where('brand_id',$request->brand);
        // }
        // if($request->input('product')!=null){
        //     $data = $data->where('product_id',$request->product);
        // }
        // if($request->input('material')!=null){
        //     $data = $data->where('material_id',$request->material);
        // }


        // $recordsFiltered = $data->get()->count();
        // if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        // $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();


		$materialId = $request->material;
		$productId = $request->product;

		$query = Stock::query();
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

    // public function index(Request $request)
    // {
    //     // return $request->all();
    //     if($request->ajax()){
    //         $limit = $request->input('length');
    //         $offset = $request->input('start');
    //         $draw = $request->input('draw');
    //         $stocks = Stock::select('stocks.*');
    //         // ->addSelect('products.brand_id as product')
    //         // ->addSelect('materials.product_id as material');

    //         if ($request->product && $request->product!="") {
    //             $brand_id = \App\Models\Product::where('brand_id',$request->product)->get();
    //             $array_brand_id = [];
    //             foreach($brand_id as $brandId){
    //                 array_push($array_brand_id, $brandId->brand_id);
    //             }
    //             $stocks->whereIn('brands.id',$array_brand_id);
    //         }

    //         if ($request->material && $request->material!="") {
    //             $product_id = \App\Models\Materials::where('product_id',$request->port)->get();
    //             $array_product_id = [];
    //             foreach($product_id as $productId){
    //                 array_push($array_product_id, $productId->product_id);
    //             }
    //             $stocks->whereIn('products.id',$array_product_id);
    //         }

    //         if ($request->input('order')!=null) {
    //             $columnIndex = $request->input('order')[0]['column']; // Column index
    //             $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
    //             $stocks->orderBy($columnName, $request->input('order')[0]['dir']);
    //         }

    //         if ($request->id) {
    //             $stocks->where('stocks.id','like','%'.$request->id.'%');
    //         }
    //         if ($request->date) {
    //             $stocks->where('date','like','%'.$request->date.'%');
    //         }
    //         if ($request->total) {
    //             $stocks->where('total','like','%'.$request->total.'%');
    //         }

    //         $total = $stocks->count();
    //         $stocks->take($limit)->skip($offset);
    //         $output=array();

    //         $data = array();
    //         foreach ($stocks->get() as $key => $row) {
    //             $item["id"] = $row->id;
    //             $item["date"] = $row->date;
    //             $item["product"] = $row->materials[0]->product->brand->name;
    //             $item["material"] = $row->materials[0]->name;
    //             $item["total"] = $row->total;

    //             $item['action'] = '<a href="#" class="btn btn-sm btn-info mr-2" data-toggle="edit"><i class="fa fa-edit"></i></a>';
    //             $item['action'] .= '<a href="#"  data-id="' . $row['id'] . '" rel="noreferrer"class="btn btn-delete btn-sm btn-danger" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>';
    //             $data[] = $item;
    //         }
    //         $output['data'] = $data;
    //         $output['draw'] = $draw;
    //         $output['recordsTotal'] = $output['recordsFiltered'] = $total;
    //         return json_encode($output);
    //     }
    //     $data['months'] = Stock::months();
    //     $data['start_year'] = Stock::startYearFilter();
    //     $data['year'] = Stock::endYearFilter();
    //     return view('ui.frontend.report.plastic', $data);
    // }
}

