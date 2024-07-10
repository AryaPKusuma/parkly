<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:16',
            'notelp' => 'required|max:13|unique:users'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            User::create($request->all());
        } catch (\Exception $e) {
            unset($validatedData);
        }

        $headers = [
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
        ];

        return response()->json(['message' => 'User registered successfully'], 200, $headers);
    }
}
