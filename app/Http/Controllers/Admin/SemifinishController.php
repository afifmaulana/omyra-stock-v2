<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Product;
use App\Models\Semifinish;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SemifinishController extends Controller
{
    public function index()
    {
        $semifinishes = Semifinish::orderBy('id', 'DESC')->get();
        return view('ui.admin.semifinish.index', [
            'semifinishes' => $semifinishes,
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.admin.semifinish.create', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // dd(Carbon::createFromFormat('d/m/Y', $request->unloading_date)->format('Y-m-d'));
        // dd($request->all());
        $semifinish = new Semifinish();
        $semifinish->product_id = $request->product;
        $semifinish->material_id = $request->material;
        $semifinish->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $semifinish->unloading_date = Carbon::createFromFormat('d/m/Y', $request->unloading_date)->format('Y-m-d');
        $semifinish->total = $request->total;
        $semifinish->user_id = Auth::user()->id;

        $material = Materials::find($request->material);
        $product = Product::find($request->product);

        // PROSES PENGURANGAN STOK MATERIAL PLASTIC
        $material->stock -= $request->total;
        // PROSES PENAMBAHAN STOK SEMIFINISH PADA PRODUK
        $product->stock_semifinish += $request->total;

        $semifinish->save();
        $material->update();
        $product->update();

        return redirect()->route('admin.semifinish.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }
}
