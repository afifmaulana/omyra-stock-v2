<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finish;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishController extends Controller
{
    public function index()
    {
        $finishes = Finish::orderBy('id', 'DESC')->get();
        return view('ui.admin.finish.index', [
            'finishes' => $finishes,
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.admin.finish.create', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $finish = new Finish();
        $finish->product_id = $request->product;
        $finish->inner_id = $request->inner;
        $finish->need_inner = $request->need_inner;
        $finish->master_id = $request->master;
        $finish->total = $request->total;
        $finish->user_id = Auth::user()->id;

        $product = Product::find($request->product);
        $inner = Materials::find($request->inner);
        $master = Materials::find($request->master);

        $product->stock_semifinish -= $request->total;
        $product->stock_finish += $request->total;

        $inner->stock -= $request->need_inner;

        $master->stock -= $request->total;

        $finish->save();
        $product->update();
        $inner->update();
        $master->update();

        return redirect()->route('admin.finish.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }
}
