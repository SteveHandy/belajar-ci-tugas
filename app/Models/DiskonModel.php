<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class DiskonModel extends Model
{
    protected $table = 'diskon';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tanggal',
        'nominal',
        'created_at',
        'updated_at'
    ];
    public function getDiskonHariIni(): ?array
    {
        // Ambil tanggal hari ini dalam format YYYY-MM-DD
        $today = Time::now('Asia/Jakarta')->toDateString();

        // Cari di database dimana kolom 'tanggal' sama dengan tanggal hari ini
        // first() akan mengembalikan satu baris hasil pertama atau null
        return $this->where('tanggal', $today)->first();
    }
}
