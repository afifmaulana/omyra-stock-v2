<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RecordLog;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function recordPlastic()
    {
        $records = RecordLog::whereHas('material', function ($query) {
            $query->where('type', 'plastic');
            $query->where('modelable_type', 'App\Models\Stock');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.plastic', [
            'records' => $records,
        ]);
    }

    public function recordInner()
    {
        $records = RecordLog::whereHas('material', function ($query) {
            $query->where('type', 'inner');
            $query->where('modelable_type', 'App\Models\Stock');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.inner', [
            'records' => $records,
        ]);
    }

    public function recordMaster()
    {
        $records = RecordLog::whereHas('material', function ($query) {
            $query->where('type', 'master');
            $query->where('modelable_type', 'App\Models\Stock');
        })->orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.master', [
            'records' => $records,
        ]);
    }

    public function recordSemifinish()
    {
        $records = RecordLog::where('modelable_type', 'App\Models\Semifinish')->orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.semifinish', [
            'records' => $records,
        ]);
    }

    public function recordFinish()
    {
        $records = RecordLog::where('modelable_type', 'App\Models\Finish')->orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.record.finish', [
            'records' => $records,
        ]);
    }
}
