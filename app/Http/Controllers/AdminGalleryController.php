<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        // Mengambil semua media, diurutkan berdasarkan sort_order
        $medias = MediaGallery::orderBy('sort_order', 'asc')->get();
        return view('admin.galeri', compact('medias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,photo',
            'category' => 'required|string',
            'file' => 'required|file|mimes:mp4,jpg,jpeg,png|max:51200', // Maksimal 50MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Tentukan folder penyimpanan
            $folder = $request->type === 'video' ? 'gallery/videos' : 'gallery/images';
            
            // Simpan file fisik
            $path = $file->store($folder, 'public');

            // Simpan ke Database
            MediaGallery::create([
                'title' => $request->title,
                'description' => $request->description ?? '-',
                'file_path' => $path,
                'type' => $request->type,
                'category' => $request->category,
                'status' => 'published', // Pastikan kolom ini sesuai database Anda
                'sort_order' => (MediaGallery::max('sort_order') ?? 0) + 1,
            ]);

            return redirect()->back()->with('success', 'Media berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal meng-upload file.');
    }

    public function destroy($id)
    {
        $media = MediaGallery::findOrFail($id);
        
        // Hapus file fisik dari folder
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }
        
        // Hapus dari database
        $media->delete();

        return redirect()->back()->with('success', 'Media berhasil dihapus!');
    }
}