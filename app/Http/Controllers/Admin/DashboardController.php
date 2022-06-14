<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $log = LogActivity::orderBy('id', 'DESC')->paginate('5');
        return view('ui.admin.index',[
            'log' => $log
        ]);
    }
}
