<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $p = [
            [
                'id' => 1,
                'name' => 'arya'
            ],
            [
                'id' => 2,
                'name' => 'budi'
            ],
        ];

        return response()->json($p);
    }
}
