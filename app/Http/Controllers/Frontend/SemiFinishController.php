<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\RecordLog;
use App\Models\Semifinish;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemiFinishController extends Controller
{
    public function index()
    {
        $semifinishes = Semifinish::orderBy('id', 'DESC')->get();
        return view('ui.frontend.semi-finished.index', [
            'semifinishes' => $semifinishes,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.semi-finished.create', [
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // dd(Carbon::createFromFormat('d/m/Y', $request->unloading_date)->format('Y-m-d'));
        // dd($request->all());
        $semifinish = new Semifinish();
        // $semifinish->product_id = $request->product;
        $semifinish->material_id = $request->material;
        $semifinish->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $semifinish->unloading_date = Carbon::createFromFormat('d-m-Y', $request->unloading_date)->format('Y-m-d');
        $semifinish->total = $request->total;
        $semifinish->user_id = Auth::user()->id;

        $material = Materials::find($request->material);
        $product = $material->product;
        $semifinish->product_id = $product->id;
         // $product = Product::find($request->product);
         $stock_before = $material->stock;
        // PROSES PENGURANGAN STOK MATERIAL PLASTIC
        $material->stock -= $request->total;
        // PROSES PENAMBAHAN STOK SEMIFINISH PADA PRODUK
        $product->stock_semifinish += $request->total;

        $semifinish->save();
        $material->update();
        $product->update();

        $data = [
            'brand_id' => $material->product->brand_id,
            'product_id' => $material->product_id,
            'material_id' => $material->id,
            'modelable_id' => $semifinish->id,
            'modelable_type' => Stock::class,
            'type' => 'Stok Plastik',
            'date' => $semifinish->date,
            'stock_before' => $stock_before,
            'total' => $semifinish->total,
            'stock_now' => $stock_before + $semifinish->total,
        ];
        RecordLog::saveRecord($data);

        $title = $description = Auth::user()->name . ' telah menambahkan data barang 1/2 jadi '.
                                    $material->product->brand->name . '/' . $material->product->size . ' ' .
                                    $material->name . ' sebanyak ' . $semifinish->total;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $semifinish->id;
            $log->source_type = '\App\Semifinish';
            $log->title = $title;
            $log->description = $description;
            $log->save();

        return redirect()->route('frontend.semi-finish.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }
}
