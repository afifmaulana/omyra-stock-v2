<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RecordLog;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function recordPlastic()
    {
        $records = RecordLog::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.plastic', [
            'records' => $records,
        ]);
    }
}
