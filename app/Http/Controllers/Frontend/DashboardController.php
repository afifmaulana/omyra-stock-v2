<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Materials;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_inner = Materials::where('type', 'inner')->sum('stock');
        $total_master = Materials::where('type', 'master')->sum('stock');
        $total_plastic = Materials::where('type', 'plastic')->sum('stock');
        $stock_semifinish = Product::sum('stock_semifinish');
        $log = LogActivity::orderBy('id', 'DESC')->paginate('5');
        return view('ui.frontend.dashboard.dashboard',[
            'log' => $log,
            'total_inner' => $total_inner,
            'total_master' => $total_master,
            'total_plastic' => $total_plastic,
            'stock_semifinish' => $stock_semifinish,
        ]);
    }
}
