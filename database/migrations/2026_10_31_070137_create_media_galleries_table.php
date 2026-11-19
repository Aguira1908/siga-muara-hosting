<?php

namespace Database\Seeders;

use App\Models\MediaGallery;
use Illuminate\Database\Seeder;

class MediaGallerySeeder extends Seeder
{
    public function run(): void
    {
        MediaGallery::insert([
            // ===== VIDEO PELABUHAN =====
            [
                'type'         => 'video',
                'category'     => 'pelabuhan',
                'title'        => 'Keindahan Pelabuhan Muara — Video 1',
                'description'  => 'Panorama pelabuhan Muara.',
                'file_path'    => 'gallery/videos/pelabuhan-1.mp4',
                'video_url'    => null,
                'sort_order'   => 1,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'type'         => 'video',
                'category'     => 'pelabuhan',
                'title'        => 'Keindahan Pelabuhan Muara — Video 2',
                'description'  => 'Aktivitas di sekitar pelabuhan Muara.',
                'file_path'    => 'gallery/videos/pelabuhan-2.mp4',
                'video_url'    => null,
                'sort_order'   => 2,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // ===== FOTO ECENG GONDOK =====
            [
                'type'         => 'photo',
                'category'     => 'eceng_gondok',
                'title'        => 'Eceng Gondok di Muara — Foto 1',
                'description'  => 'Kondisi eceng gondok sebelum gotong royong.',
                'file_path'    => 'gallery/photos/eceng-1.jpg',
                'video_url'    => null,
                'sort_order'   => 1,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}