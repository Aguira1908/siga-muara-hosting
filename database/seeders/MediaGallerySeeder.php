<?php

namespace Database\Seeders;

use App\Models\MediaGallery;
use Illuminate\Database\Seeder;

class MediaGallerySeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak dobel
        MediaGallery::truncate();

        MediaGallery::insert([
            // ===== VIDEO PELABUHAN =====
            [
                'type'         => 'video',
                'category'     => 'pelabuhan',
                'title'        => 'Keindahan Pelabuhan Muara — Video 1',
                'description'  => 'Panorama pelabuhan Muara.',
                'file_path'    => 'gallery/videos/11.mp4',
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
                'file_path'    => 'gallery/videos/12.mp4',
                'sort_order'   => 2,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // ===== FOTO (KITA MASUKKAN KE KATEGORI ECENG GONDOK DULU) =====
            [
                'type'         => 'photo',
                'category'     => 'eceng_gondok',
                'title'        => 'Kapal di Muara',
                'description'  => 'Pemandangan kapal di area muara.',
                'file_path'    => 'gallery/photos/kmp1.jpg',
                'sort_order'   => 1,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'type'         => 'photo',
                'category'     => 'eceng_gondok',
                'title'        => 'Pulau Sibandang',
                'description'  => 'Pemandangan indah Pulau Sibandang.',
                'file_path'    => 'gallery/photos/pulau-sibandang.jpg',
                'sort_order'   => 2,
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}