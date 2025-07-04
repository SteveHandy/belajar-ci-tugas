<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time; // Import class Time untuk kemudahan manipulasi tanggal

class DiskonSeeder extends Seeder
{
    public function run()
    {
        // Menyiapkan array kosong untuk menampung data
        $data = [];

        // Mengambil waktu saat ini sesuai timezone
        $currentTime = Time::now('Asia/Jakarta');

        // Loop untuk membuat 10 data
        for ($i = 0; $i < 10; $i++) {
            $tanggal = Time::now('Asia/Jakarta')->addDays($i)->toDateString(); // Format YYYY-MM-DD

            $data[] = [
                'tanggal'      => $tanggal,
                'nominal'      => mt_rand(10, 50) * 10000,
                'created_at'   => $currentTime->toDateTimeString(),
                'updated_at'   => $currentTime->toDateTimeString(),
            ];
        }

        // Menggunakan Query Builder untuk memasukkan semua data sekaligus (lebih efisien)
        $this->db->table('diskon')->insertBatch($data);
    }
}
