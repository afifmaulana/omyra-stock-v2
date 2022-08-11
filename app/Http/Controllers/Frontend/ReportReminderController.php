<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReportReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::orderBy('id', 'DESC')->get();
        return view('ui.frontend.report.reminder.index', [
            'reminders' => $reminders,
        ]);
    }
}
