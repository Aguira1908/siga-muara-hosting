<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::create([
            'title' => 'Gotong Royong Bersihkan Eceng Gondok di Pelabuhan',
            'description' => 'Kegiatan rutin membersihkan eceng gondok yang menutupi area pelabuhan.',
            'location_name' => 'Pelabuhan Muara',
            'date' => date('Y-m-d', strtotime('+3 days')), // 3 hari dari sekarang
            'time' => '08:00:00',
            'meeting_point' => 'Kantor Desa Muara',
            'volunteer_needed' => 50,
            'pic_name' => 'Budi (Operator)',
            'pic_phone' => '081234567890',
            'safety_notes' => 'Wajib membawa sarung tangan dan memakai pelampung jika turun ke perahu.',
            'status' => 'published',
        ]);
    }
}