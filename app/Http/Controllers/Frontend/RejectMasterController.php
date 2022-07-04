<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use App\Models\RecordLog;
use App\Models\Reject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RejectMasterController extends Controller
{
    public function index()
    {
        $rejects = Reject::whereHas('material', function ($query) {
            $query->where('type', 'master');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.reject.master.index',[
            'rejects' => $rejects,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.reject.master.create',[
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            //  dd($request->all());
            $reject = new Reject();
            $reject->material_id = $request->material;
            $reject->total = $request->total;
            $reject->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
            $reject->user_id = Auth::user()->id;
            $reject->save();

            $material = Materials::find($reject->material_id);
            $stock_before = $material->stock; //Mengambil stok sebelum dikurangi
                $material->stock -= $reject->total; //pengurangan stok
                $material->update();

                //Proses penyimpanan log/history pengurangan stok plastik
                $dataStock = [
                    'brand_id' => $material->product->brand_id,
                    'product_id' => $material->product_id,
                    'material_id' => $material->id,
                    'modelable_id' => $reject->id,
                    'modelable_type' => 'App\Models\Stock',
                    'type' => 'Barang Reject',
                    'type_calculation' => '-',
                    'date' => $reject->date,
                    'stock_before' => $stock_before,
                    'total' => $reject->total,
                    'stock_now' => $stock_before -= $reject->total,
                ];
                RecordLog::saveRecord($dataStock);



                $title = $description = Auth::user()->name . ' telah menambahkan master reject'.
                                        $material->product->brand->name . '/' . $material->product->size . ' ' .
                                        $material->name . ' sebanyak ' . $reject->total;
                $log = new LogActivity();
                $log->user_id = Auth::user()->id;
                $log->source_id = $reject->id;
                $log->source_type = '\App\Reject';
                $log->title = $title;
                $log->description = $description;
                $log->save();

                DB::commit();

                return redirect()->route('frontend.reject.master.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th->getMessage());
            }
    }

    public function destroy($id)
    {
        $reject = Reject::where('id', $id)->first();
        // dd($reject);
        $reject->delete();

            $title = $description = Auth::user()->name . ' telah menghapus stok master dengan ID #'. $reject->id;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $reject->id;
            $log->source_type = '\App\Reject';
            $log->title = $title;
            $log->description = $description;
            $log->save();
        return redirect()->route('frontend.reject.master.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
