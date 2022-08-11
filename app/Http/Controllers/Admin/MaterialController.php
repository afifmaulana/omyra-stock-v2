<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Materials::orderBy('id', 'DESC')->get();
        return view('ui.admin.material.index', [
            'materials' => $materials,
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('id', 'ASC')->get();
        return view('ui.admin.material.create', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $material = new Materials();
        $material->product_id = $request->product;
        $material->name = $request->name;
        $material->type = $request->type;
        $material->user_id = Auth::user()->id;
        $material->save();

            $title = $description = Auth::user()->name . ' telah menambahkan jenis brand baru ' . $material->name . ' Brand ' .
            $material->product->brand->name . '/' . $material->product->size ;
            $log = new LogActivity();  
            $log->user_id = Auth::user()->id;
            $log->source_id = $material->id;
            $log->source_type = '\App\Material';
            $log->title = $title;
            $log->description = $description;
            $log->save();

        return redirect()->route('admin.material.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $material = Materials::where('id', $id)->first();
        return view('ui.admin.material.edit', [
            'material' => $material,
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        $material = Materials::where('id', $id)->first();
        $params = $request->all();

        $material->update([
            'product_id' => $params['product_id'] ?? $material->product_id,
            'name' => $params['name'] ?? $material->name,
            'type' => $params['type'] ?? $material->type,
        ]);

            $title = $description = Auth::user()->name . ' telah mengubah jenis brand ' . $material->name;
            $log = new LogActivity();
            $log->user_id = Auth::user()->id;
            $log->source_id = $material->id;
            $log->source_type = '\App\Material';
            $log->title = $title;
            $log->description = $description;
            $log->save();

        return redirect()->route('admin.material.index')->with('success', 'Berhasil mengubah Material!');

    }

    public function destroy($id)
    {
        $material = Materials::where('id', $id)->first();
        // dd($material);
        $material->delete();
        return redirect()->route('admin.material.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
