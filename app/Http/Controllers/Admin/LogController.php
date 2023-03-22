<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    function index()
    {
        dd(Log::debug('An informational message.'));
    }
}
