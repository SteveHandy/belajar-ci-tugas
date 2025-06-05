<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category_name',
        'status',
        'created_at',
        'updated_at'
    ];
}
