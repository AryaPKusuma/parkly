<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function show(){
        $user = Auth::user();
        $favorites = $user->favorites;

        return view('dashboard.favorite', compact('favorites'));
    }

    public function add(Request $request){
        $userId = Auth::id();
        $parkingLotId = $request->input('parkinglot_id');

        Favorite::create([
            'user_id' => $userId,
            'parkinglot_id' => $parkingLotId,
        ]);

        return redirect()->back()->with('success', 'Tempat parkir ditambahkan ke favorit.');
    }

    public function destroy($id)
    {
    $favorit = Favorite::findOrFail($id);
    $favorit->delete();

    return redirect()->back()->with('success', 'Data parkir berhasil dihapus');
    }

}
