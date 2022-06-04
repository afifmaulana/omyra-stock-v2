<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.admin.product.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('ui.admin.product.create', [
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->brand_id = $request->brand;
        $product->size = $request->size;
        $product->need_inner = $request->inner;
        $product->user_id = Auth::user()->id;
        $product->save();
        return redirect()->route('admin.product.index')->with(['success' => 'Data baru berhasil ditambahkan.']);
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('admin.product.index')->with(['success' => 'Berhasil menghapus data.']);
    }
}
