<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('ui.admin.brand.index', [
            'brands' => $brands,
        ]);
    }

    public function create()
    {
        return view('ui.admin.brand.create');
    }

    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->user_id = Auth::user()->id;
        $brand->save();
        return redirect()->route('admin.brand.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $brand = Brand::where('id', $id)->first();
        return view('ui.admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $brand = Brand::where('id', $id)->first();
        $params = $request->all();

        $brand->update([
            'name' => $params['name'] ?? $brand->name,
        ]);
        return redirect()->route('admin.brand.index')->with('success', 'Berhasil mengubah Brand!');
    }

    public function destroy($id)
    {
        $brand = Brand::where('id', $id)->first();
        $brand->delete();
        return redirect()->route('admin.brand.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
