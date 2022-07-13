<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\RecordLog;
use App\Models\Reject;
use App\Models\Semifinish;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlasticController extends Controller
{
    public function index()
    {
        $stocks = Stock::whereHas('material', function ($query) {
            $query->where('type', 'plastic');
            $query->with('semifinishes');
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


            $title = $description = Auth::user()->name . ' telah menambahkan stok plastik ' .
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

            return redirect()->route('frontend.plastic.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
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
        return view('ui.frontend.stocks.plastic.edit', [
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
            $title = $description = 'Stok Plastik dengan ID #' . $stock->id . ' telah diubah oleh Mas ' . Auth::user()->name;
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
            $totalSemifinish = Semifinish::where('material_id', $material->id)->sum('total');
            $totalReject = Reject::where('material_id', $material->id)->sum('total');

            $material->stock = ($stock->total - $totalSemifinish - $totalReject);
            $material->update();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return redirect()->route('frontend.plastic.index')->with('success', 'Berhasil mengubah data');
    }

    public function detail($id)
    {
        $stock = Stock::where('id', $id)->first();
        // $materialId = Stock::where('material_id')->first();
        $records = RecordLog::whereHas('material', function ($query) {
            $query->where('type', 'plastic');
            $query->where('modelable_type', 'App\Models\Stock');
            // $query->where($materialId)->first();
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.stocks.plastic.detail', [
            'stock' => $stock,
            'records' => $records,
        ]);
    }
    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {

            $stock = Stock::where('id', $id)->first();

            $material = Materials::find($stock->material_id);

            //mengambil stok sebelumnya
            $stock_before = $material->stock;
            //stok berkurang ketika data di hapus
            $material->stock -= $stock->total;
            // dd($stock);
            $material->update();


            $data = [
                'brand_id' => $material->product->brand_id,
                'product_id' => $material->product_id,
                'material_id' => $material->id,
                'modelable_id' => $stock->id,
                'modelable_type' => Stock::class,
                'type' => 'Data Dihapus',
                'type_calculation' => '-',
                'date' => $stock->date,
                'stock_before' => $stock_before,
                'total' => $stock->total,
                'stock_now' => $stock_before -= $stock->total,
            ];
            RecordLog::saveRecord($data);

            $title = $description = Auth::user()->name . ' telah menghapus stok plastik dengan ID #' . $stock->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $stock->id;
            $log->source_type = '\App\Stock';
            $log->title = $title;
            $log->description = $description;
            $log->save();

            $stock->delete();
            DB::commit();

            return redirect()->route('frontend.plastic.index')->with(['success' => 'Berhasil menghapus data.']);


        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

    }
}
