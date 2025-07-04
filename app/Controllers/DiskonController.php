<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;
use CodeIgniter\HTTP\ResponseInterface;

class DiskonController extends BaseController
{
    protected $diskon;

    function __construct()
    {
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $diskon = $this->diskon->findAll();
        $data['diskon'] = $diskon;

        return view('v_diskon', $data);
    }

    public function create()
    {
        $rules = [
            'tanggal' => [
                'rules' => 'required|is_unique[diskon.tanggal]',
                'errors' => [
                    'required' => 'Kolom Tanggal harus diisi.',
                    'is_unique' => 'Diskon untuk tanggal ini sudah terdaftar. Silakan pilih tanggal lain.'
                ]
            ],
            'nominal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom Nominal harus diisi.',
                    'numeric' => 'Kolom Nominal hanya boleh berisi angka.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'created_at' => date("Y-m-d H:i:s")
        ];


        $this->diskon->insert($dataForm);

        return redirect('diskon')->with('success', 'Diskon Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataDiskon = $this->diskon->find($id);

        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->diskon->update($id, $dataForm);

        return redirect('diskon')->with('success', 'Diskon Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataDiskon = $this->diskon->find($id);

        $this->diskon->delete($id);

        return redirect('diskon')->with('success', 'Diskon Berhasil Dihapus');
    }
}
