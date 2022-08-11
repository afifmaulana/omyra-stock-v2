<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class ReportBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.brand.index', [
            'brands' => $brands,
        ]);
    }
}
