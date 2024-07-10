<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'tittle' => 'Register',
            'active' => 'register'
        ]);
    }

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

            return redirect('/login')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            unset($validatedData);

            return redirect()->back()->with('error', 'Registrasi gagal: ' . $e->getMessage());
        }

    }
}
