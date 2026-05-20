<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::latest()->paginate(10);

        return view('logs.index', compact('logs'));
    }
}