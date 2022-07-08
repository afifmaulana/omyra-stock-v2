<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\RecordLog;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function index()
    {
        $stocks = Stock::whereHas('material', function ($query) {
            $query->where('type', 'master');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.stocks.master.index', [
            'stocks' => $stocks,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.stocks.master.create', [
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());
            $stock = new Stock();
            $stock->material_id = $request->material;
            $stock->total = $request->total;
            $stock->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
            $stock->user_id = Auth::user()->id;
            $stock->save();

            $material = Materials::find($stock->material_id);

            //mengambil stok sebelumnya
            $stock_before = $material->stock;

            //penambahan stok
            $material->stock += $stock->total;
            $material->update();

            $data = [
                'brand_id' => $material->product->brand_id,
                'product_id' => $material->product_id,
                'material_id' => $material->id,
                'modelable_id' => $stock->id,
                'modelable_type' => Stock::class,
                'type' => 'Barang Masuk',
                'type_calculation' => '+',
                'date' => $stock->date,
                'stock_before' => $stock_before,
                'total' => $stock->total,
                'stock_now' => $stock_before += $stock->total,
            ];
            RecordLog::saveRecord($data);

                $title = $description = Auth::user()->name . ' telah menambahkan stok master '.
                                        $material->product->brand->name . '/' . $material->product->size . ' ' .
                                        $material->name . ' sebanyak ' . $stock->total;
                $log = new LogActivity();
                $log->user_id = Auth::user()->id;
                $log->source_id = $stock->id;
                $log->source_type = '\App\Stock';
                $log->title = $title;
                $log->description = $description;
                $log->save();

            DB::commit();

            return redirect()->route('frontend.master.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function edit($id)
    {
        $stock = Stock::where('id', $id)->first();
        $products = Product::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        return view('ui.frontend.stocks.master.edit', [
            'stock' => $stock,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $stock = Stock::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $title = $description = 'Stok master dengan ID #' . $stock->id . ' telah diubah oleh Mas ' . Auth::user()->name;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_type = 'App\Stock';
            $log->source_id = $stock->id;
            $log->title = $title;
            $log->description = $description;
            $log->save();

            $stock->date = Carbon::parse($request->date)->format('Y-m-d');
            $stock->material_id = $request->material;
            $stock->user_id = Auth::user()->id;
            $stock->total = $request->total;
            $stock->update();

            $material = Materials::find($stock->material_id);
            $material->stock += $stock->total;
            $material->update();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return redirect()->route('frontend.master.index')->with('success', 'Berhasil mengubah data');
    }

    public function destroy($id)
    {
        $stock = Stock::where('id', $id)->first();
        // dd($stock);
        $stock->delete();
            $title = $description = Auth::user()->name . ' telah menghapus stok master dengan ID #'. $stock->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $stock->id;
            $log->source_type = '\App\Stock';
            $log->title = $title;
            $log->description = $description;
            $log->save();
        return redirect()->route('frontend.master.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
