<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlasticController extends Controller
{
    public function index()
    {
        $stocks = Stock::whereHas('material', function ($query) {
            $query->where('type', 'plastic');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.stocks.plastic.index', [
            'stocks' => $stocks,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.stocks.plastic.create', [
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $stock = new Stock();
        $stock->material_id = $request->material;
        $stock->total = $request->total;
        $stock->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $stock->user_id = Auth::user()->id;
        $stock->save();

        $material = Materials::find($stock->material_id);
        $material->stock += $stock->total;
        $material->update();

            $title = $description = Auth::user()->name . ' telah menambahkan stok plastik '.
                                    $material->product->brand->name . '/' . $material->product->size . ' ' .
                                    $material->name . ' sebanyak ' . $stock->total;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $stock->id;
            $log->source_type = '\App\Stock';
            $log->title = $title;
            $log->description = $description;
            $log->save();

        return redirect()->route('frontend.plastic.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function destroy($id)
    {
        $stock = Stock::where('id', $id)->first();
        // dd($stock);
        $stock->delete();

            $title = $description = Auth::user()->name . ' telah menghapus stok plastik dengan ID #'. $stock->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $stock->id;
            $log->source_type = '\App\Stock';
            $log->title = $title;
            $log->description = $description;
            $log->save();
        return redirect()->route('frontend.plastic.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
