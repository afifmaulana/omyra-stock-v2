<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function index()
    {
        return view('ui.frontend.reject.index');
    }
}
