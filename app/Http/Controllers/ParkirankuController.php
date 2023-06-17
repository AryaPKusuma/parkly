<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParkirankuController extends Controller
{
        public function index()
    {
        return view('dashboard.parkiranku');
    }
}
