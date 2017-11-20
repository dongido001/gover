<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageLogController extends Controller
{
    public function index()
    {
        return view('admin.message_logs.index');
    }
}
