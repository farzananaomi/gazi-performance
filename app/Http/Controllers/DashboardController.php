<?php

namespace GaziWorks\Performance\Http\Controllers;

use Illuminate\Http\Request;

use GaziWorks\Performance\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
        return view('layouts.base');
    }
}
