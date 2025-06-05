<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'category_name' => 'Elektronik',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'category_name' => 'Pakaian',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'category_name' => 'Makanan & Minuman',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('product_category')->insert($item);
        }
    }
}
