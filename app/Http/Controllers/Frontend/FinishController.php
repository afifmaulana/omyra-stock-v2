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

    public function edit($id)
    {
        $finish = Finish::where('id', $id)->first();
        $products = Product::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        return view('ui.frontend.finished.edit', [
            'finish' => $finish,
            'products' => $products,
            'brands' => $brands,

        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $finish = Finish::where('id', $id)->first();
        DB::beginTransaction();
        try {
            $title = $description = 'Stok Barang Jadi dengan ID #' . $finish->id . ' telah diubah oleh Mba ' . Auth::user()->name;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_type = 'App\Finish';
            $log->source_id = $finish->id;
            $log->title = $title;
            $log->description = $description;
            $log->save();

            $finish->product_id = $request->product;
            $finish->inner_id = $request->inner;
            $finish->need_inner = $request->need_inner;
            $finish->master_id = $request->master;
            $finish->total = $request->total;
            $finish->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
            $finish->user_id = Auth::user()->id;
            $finish->update();

            $material = Materials::find($request->material);
            $product = $material->product;
            $finish->product_id = $product->id;
            $totalFinish = Finish::where('material_id', $material->id)->sum('total');
            // $totalReject = Reject::where('material_id', $material->id)->sum('total');

            $product->stock_semifinish = ($finish->total - $totalFinish);
            $product->update();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return redirect()->route('frontend.finish.index')->with('success', 'Berhasil mengubah data');
    }

    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {

            $finish = Finish::where('id', $id)->first();

            $inner = Materials::find($finish->inner_id);
            $master = Materials::find($finish->master_id);
            $product = $inner->product;
            $finish->product_id = $product->id;

            //Mengambil stok barang 1/2 jadi sebelum dikembalikan
            $stock_semifinish_before = $product->stock_semifinish;
            //pengembalian stok barang 1/2 jadi karena data barang jadi dihapus
            $product->stock_semifinish += $finish->need_inner;

            //Mengambil stok barang jadi sebelum dihapus
            $stock_finish_before = $product->stock_finish;
            //pengurangan stok barang jadi karena data dihapus
            $product->stock_finish -= $finish->total;

            //Mengambil stok inner sebelum dikembalikan karena barang tidak jadi dipakai
            $stock_inner_before = $inner->stock;
            //pengembalian stok inner karena tidak jadi dipakai / Data barang jadi telah dihapus
            $inner->stock += $finish->need_inner;

            //Mengambil stok master sebelum dikembalikan
            $stock_master_before = $master->stock;
            //pengembalian stok Master karena tidak jadi dipakai / Data barang jadi telah dihapus
            $master->stock += $finish->total;

            $finish->save();
            $product->update();
            $inner->update();
            $master->update();


            //Proses penyimpanan log/history pengembalian stok barang 1/2 jadi
            $dataSemifinish = [
                'brand_id' => $master->product->brand_id,
                'product_id' => $master->product_id,
                'material_id' => $master->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Semifinish',
                'type' => 'Data Dikembalikan',
                'type_calculation' => '+',
                'date' => $finish->date,
                'stock_before' => $stock_semifinish_before,
                'total' => $finish->need_inner,
                'stock_now' => $stock_semifinish_before += $finish->need_inner,
            ];
            RecordLog::saveRecord($dataSemifinish);

            //Proses penyimpanan log/history Pengurangan stok barang jadi karena data dihapus
            $dataFinish = [
                'brand_id' => $inner->product->brand_id,
                'product_id' => $inner->product_id,
                'material_id' => $inner->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Finish',
                'type' => 'Data Dihapus',
                'type_calculation' => '-',
                'date' => $finish->date,
                'stock_before' => $stock_finish_before,
                'total' => $finish->total,
                'stock_now' => $stock_finish_before -= $finish->total,
            ];
            RecordLog::saveRecord($dataFinish);

            //Proses penyimpanan log/history pengembalian stok Inner karena tidak jadi dipakai
            $dataInner = [
                'brand_id' => $inner->product->brand_id,
                'product_id' => $inner->product_id,
                'material_id' => $inner->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Stock',
                'type' => 'Data Dikembalikan',
                'type_calculation' => '+',
                'date' => $finish->date,
                'stock_before' => $stock_inner_before,
                'total' => $finish->need_inner,
                'stock_now' => $stock_inner_before += $finish->need_inner,
            ];
            RecordLog::saveRecord($dataInner);

            //Proses penyimpanan log/history pengembalian stok master karena tidak jadi dipakai
            $dataMaster = [
                'brand_id' => $master->product->brand_id,
                'product_id' => $master->product_id,
                'material_id' => $master->id,
                'modelable_id' => $finish->id,
                'modelable_type' => 'App\Models\Stock',
                'type' => 'Data Dikembalikan',
                'type_calculation' => '+',
                'date' => $finish->date,
                'stock_before' => $stock_master_before,
                'total' => $finish->total,
                'stock_now' => $stock_master_before += $finish->total,
            ];
            RecordLog::saveRecord($dataMaster);


            $title = $description = Auth::user()->name . ' telah menghapus stok barang jadi dengan ID #' . $finish->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $finish->id;
            $log->source_type = '\App\Finish';
            $log->title = $title;
            $log->description = $description;
            $log->save();

            $finish->delete();
            DB::commit();

            return redirect()->route('frontend.finish.index')->with(['success' => 'Berhasil menghapus data.']);


        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

    }
}
