<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Materials::all();
        return view('ui.admin.material.index', [
            'materials' => $materials,
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('id', 'DESC')->get();
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
        return redirect()->route('admin.material.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function destroy($id)
    {
        $material = Materials::where('id', $id)->first();
        dd($material);
        $material->delete();
        return redirect()->route('admin.material.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
