<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class AdminController extends Controller
{    
    
    public function createNews()
    {
        return view('admin.createNews');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:berita,video',
            'file_path' => 'required|file|mimes:jpg,png,jpeg,gif,mp4,avi',
        ]);
    
        // Menentukan folder penyimpanan berdasarkan kategori
        if ($request->category === 'video') {
            $filePath = $request->file('file_path');
            $filePath->storeAs('public/videos', $filePath->hashName());
            $storagePath = 'storage/videos/' . $filePath->hashName();
        } else {
            $filePath = $request->file('file_path');
            $filePath->storeAs('public/images', $filePath->hashName());
            $storagePath = 'storage/images/' . $filePath->hashName();
        }
    
        // Membuat objek Artwork baru dan menyimpan data ke database
        $artwork = new Artwork();
        $artwork->title = $request->title;
        $artwork->description = $request->description;
        $artwork->category = $request->category;
        $artwork->file_path = $storagePath;
        $artwork->student_id = auth()->id(); // Mengambil ID user yang login
        $artwork->submitted_at = now();
        $artwork->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Karya berhasil dikirim!');
    }
}
