<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Finish;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\RecordLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $finish = new Finish();
            $finish->product_id = $request->product;
            $finish->inner_id = $request->inner;
            $finish->need_inner = $request->need_inner;
            $finish->master_id = $request->master;
            $finish->total = $request->total;
            $finish->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
            $finish->user_id = Auth::user()->id;

            // $product = Product::find($request->product);
            $inner = Materials::find($request->inner);
            $master = Materials::find($request->master);
            $product = $inner->product;
            $finish->product_id = $product->id;

            $stock_semifinish_before = $product->stock_semifinish; //Mengambil stok barang 1/2 jadi sebelum dikurangi
            //Pengurangan stok barang 1/2 jadi
            $product->stock_semifinish -= $request->need_inner;


            $stock_finish_before = $product->stock_finish; //Mengambil stok barang jadi sebelum dikurangi
            //penambahan stok barang jadi
            $product->stock_finish += $request->total;

            $stock_inner_before = $inner->stock; //Mengambil stok sebelum dikurangi
            //Pengurangan stok inner
            $inner->stock -= $request->need_inner;

            $stock_master_before = $master->stock; //Mengambil stok sebelum dikurangi
            //Pengurangan stok Master
            $master->stock -= $request->total;

            $finish->save();
            $product->update();
            $inner->update();
            $master->update();

            //Proses penyimpanan log/history pengurangan stok barang 1/2 jadi
            $dataSemifinish = [
                'brand_id' => $master->product->brand_id,
                'product_id' => $master->product_id,
                'material_id' => $master->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Semifinish',
                'type' => 'Barang Dipakai',
                'type_calculation' => '-',
                'date' => $finish->date,
                'stock_before' => $stock_semifinish_before,
                'total' => $finish->need_inner,
                'stock_now' => $stock_semifinish_before -= $finish->need_inner,
            ];
            RecordLog::saveRecord($dataSemifinish);

            //Proses penyimpanan log/history penambahan stok barang jadi
            $dataFinish = [
                'brand_id' => $inner->product->brand_id,
                'product_id' => $inner->product_id,
                'material_id' => $inner->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Finish',
                'type' => 'Barang Masuk',
                'type_calculation' => '+',
                'date' => $finish->date,
                'stock_before' => $stock_finish_before,
                'total' => $finish->total,
                'stock_now' => $stock_finish_before += $finish->total,
            ];
            RecordLog::saveRecord($dataFinish);

            //Proses penyimpanan log/history pengurangan stok Inner
            $dataInner = [
                'brand_id' => $inner->product->brand_id,
                'product_id' => $inner->product_id,
                'material_id' => $inner->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Stock',
                'type' => 'Barang Dipakai',
                'type_calculation' => '-',
                'date' => $finish->date,
                'stock_before' => $stock_inner_before,
                'total' => $finish->need_inner,
                'stock_now' => $stock_inner_before -= $finish->need_inner,
            ];
            RecordLog::saveRecord($dataInner);

            //Proses penyimpanan log/history pengurangan stok master
            $dataMaster = [
                'brand_id' => $master->product->brand_id,
                'product_id' => $master->product_id,
                'material_id' => $master->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Stock',
                'type' => 'Barang Dipakai',
                'type_calculation' => '-',
                'date' => $finish->date,
                'stock_before' => $stock_master_before,
                'total' => $finish->total,
                'stock_now' => $stock_master_before -= $finish->total,
            ];
            RecordLog::saveRecord($dataMaster);

            $title = $description = Auth::user()->name . ' telah menambahkan data barang jadi sebanyak '. $finish->total;
                $log = new LogActivity();
                $log->user_id = Auth::user()->id;
                $log->source_id = $finish->id;
                $log->source_type = '\App\Finish';
                $log->title = $title;
                $log->description = $description;
                $log->save();

            DB::commit();

            return redirect()->route('frontend.finish.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
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
