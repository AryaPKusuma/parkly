<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input dari form
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Membuat instance model ContactUs dan mengisi properti dengan data dari form
        $contactUs = new ContactUs;
        $contactUs->name = $request->input('name');
        $contactUs->email = $request->input('email');
        $contactUs->subject = $request->input('subject');
        $contactUs->message = $request->input('message');

        // Menyimpan data ke database
        $contactUs->save();

        // Jika ingin melakukan sesuatu setelah menyimpan data, tambahkan kode di sini

        // Redirect atau berikan respon yang sesuai
        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah kami terima.');
    }

    // public function show()
    // {
    //     // Mengambil semua data pesan Contact Us
    //     $contactUsMessages = ContactUs::all();

    //     // Mengirim data pesan ke view
    //     return view('admin', compact('contactUsMessages'));
    // }

    public function deleteMessage($id)
    {
        $message = ContactUs::find($id);

        if ($message) {
            $message->delete();
            return redirect()->back()->with('success', 'Pesan berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan');
        }
    }
}
