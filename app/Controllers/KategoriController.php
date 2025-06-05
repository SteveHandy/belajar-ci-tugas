<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriController extends BaseController
{
    protected $category;

    function __construct()
    {
        $this->category = new KategoriProdukModel();
    }

    public function index()
    {
        $category = $this->category->findAll();
        $data['category'] = $category;

        return view('v_kategori', $data);
    }

    public function create()
    {

        $dataForm = [
            'category_name' => $this->request->getPost('category_name'),
            'created_at' => date("Y-m-d H:i:s")
        ];


        $this->category->insert($dataForm);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataKategori = $this->category->find($id);

        $dataForm = [
            'category_name' => $this->request->getPost('category_name'),
            'status' => $this->request->getPost('status'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->category->update($id, $dataForm);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataKategori = $this->category->find($id);

        $this->category->delete($id);

        return redirect('produk-kategori')->with('success', 'Data Berhasil Dihapus');
    }
}
