<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'photo' => 'required | image|mimes:jpeg,png,jpg,gif|max:2048',
            'notelp' => 'required|max:13|unique:users',
        ]);

        $validatedData['photo'] = $request->file('photo')->store('public/profile-user');
        $user->update($validatedData);

        return redirect()->back()->with('success', 'Data user berhasil diperbarui');
    }

    public function showUserEarningsReport()
    {
        $users = User::with('parkingLots')->get();

        foreach ($users as $user) {
            $totalProfit = $user->parkingLots->sum('profit');
            echo "Pendapatan untuk User " . $user->name . ": " . $totalProfit . "<br>";
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun user berhasil dihapus');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048' // Pastikan hanya file gambar yang diizinkan dengan maksimum ukuran 2MB
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('photo-user', $photoName, 'public');

            // Update kolom 'photo' pada tabel 'users'
            $user = User::find(auth()->user()->id);
            $user->photo = $photoName;
            $user->save();

            return redirect()->back()->with('success', 'Foto berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }
}
