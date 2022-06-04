<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockMasterController extends Controller
{
    public function index()
    {
        $stocks = Stock::whereHas('material', function ($query) {
            $query->where('type', 'master');
        })->orderBy('id', 'DESC')->get();
        return view('ui.admin.stocks.master.index', [
            'stocks' => $stocks,
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.admin.stocks.master.create', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {

        $stock = new Stock();
        $stock->material_id = $request->material;
        $stock->total = $request->total;
        $stock->user_id = Auth::user()->id;
        $stock->save();

        $material = Materials::find($stock->material_id);
        $material->stock += $stock->total;
        $material->update();

        return redirect()->route('admin.stock.master.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }
}
