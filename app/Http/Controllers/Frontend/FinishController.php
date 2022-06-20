<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Finish;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishController extends Controller
{
    public function index()
    {
        $finishes = Finish::orderBy('id', 'DESC')->get();
        return view('ui.frontend.finished.index', [
            'finishes' => $finishes,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.finished.create', [
            'brands' => $brands,
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
        $finish->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
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

        $title = $description = Auth::user()->name . ' telah menambahkan data barang jadi sebanyak '. $finish->total;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $finish->id;
            $log->source_type = '\App\Finish';
            $log->title = $title;
            $log->description = $description;
            $log->save();

        return redirect()->route('frontend.finish.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function destroy($id)
    {
        $finish = Finish::where('id', $id)->first();
        // dd($finish);
        $finish->delete();

            $title = $description = Auth::user()->name . ' telah menghapus data barang jadi dengan ID #'. $finish->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $finish->id;
            $log->source_type = '\App\Finish';
            $log->title = $title;
            $log->description = $description;
            $log->save();
        return redirect()->route('frontend.finish.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
