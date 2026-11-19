<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;

class GalleryController extends Controller
{
    public function index()
    {
        // 1. Ambil Video Keindahan Muara
        $pelabuhanVideos = MediaGallery::published()
            ->ofCategory('pelabuhan')
            ->where('type', 'video')
            ->orderBy('sort_order')
            ->get();

        // 2. Ambil Foto Eceng Gondok
        $ecengPhotos = MediaGallery::published()
            ->ofCategory('eceng_gondok')
            ->where('type', 'photo')
            ->orderBy('sort_order')
            ->get();

        // 3. Ambil Media Gotong Royong (Bisa Foto atau Video)
        $gotongRoyongMedias = MediaGallery::published()
            ->ofCategory('gotong_royong')
            ->orderBy('sort_order')
            ->get();

        return view('gallery.index', compact('pelabuhanVideos', 'ecengPhotos', 'gotongRoyongMedias'));
    }
}