<?php

namespace App\Http\Controllers;

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
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:16',
            'notelp' => 'required|max:13|unique:users'
        ]);

        User::create($validateData);

        // $request->session()->flash('status', 'Task was successful!');

        return redirect('/login')->with('success', 'Akun anda berhasil dibuat, silahkan Login');;
    }
}
