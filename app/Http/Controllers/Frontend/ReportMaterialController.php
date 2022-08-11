<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;

class ReportMaterialController extends Controller
{
    public function index()
    {
        $materials = Materials::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.material.index', [
            'materials' => $materials,
        ]);
    }
}
