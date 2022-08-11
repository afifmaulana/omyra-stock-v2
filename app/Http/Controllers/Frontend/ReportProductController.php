<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.product.index', [
            'products' => $products,
        ]);
    }
}
