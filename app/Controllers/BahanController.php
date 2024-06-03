<?php

namespace App\Controllers;

use App\Models\Bahan;
use App\Controllers\BaseController;

class BahanController extends BaseController
{
    public function index()
    {
        $model = new Bahan();

        // $currentPage = $this->request->getVar('page_bahan') ? $this->request->getVar('page_bahan') : 1;
        // $keyword = $this->request->getVar('keyword');
        // if (empty($keyword)) {
        //     $keyword = '';
        // }
        // $data = [
        //     'title' => 'Bahan',
        //     'pages' => 'Bahan',
        //     'keyword' => $keyword,
        // ];
        // $bahan = $model->like('nama', $keyword)->paginate(5, 'bahan');
        // $data['bahan'] = $bahan;
        // $data['pager'] = $model->pager;
        // $data['currentPage'] = $currentPage;

        $data = [
            'title' => 'Bahan',
            'pages' => 'Bahan',
            'bahan' => $model->get()->getResultArray()
        ];

        return view('dashboard/bahan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Bahan',
            'pages' => 'Bahan',
        ];

        return view('dashboard/bahan/create', $data);
    }

    public function store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'panjang_kain' => $this->request->getPost('panjang_kain'),
            'status' => $this->request->getPost('status')
        );
        $model = new Bahan();
        $simpan = $model->insertBahan($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Berhasil Menambah Bahan');
            return redirect()->route('bahan');
        }
    }

    public function edit($id)
    {
        $model = new Bahan();
        $data = [
            'title' => 'Edit Bahan',
            'pages' => 'Bahan',
        ];
        $data['bahan'] = $model->getBahan($id)->getRowArray();
        echo view('dashboard/bahan/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_bahan');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            // 'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'panjang_kain' => $this->request->getPost('panjang_kain'),
            'status' => $this->request->getPost('status')
        );
        $model = new Bahan();
        $ubah = $model->updateBahan($data, $id);
        if ($ubah) {
            session()->setFlashdata('info', 'Berhasil Mengedit Bahan');
            return redirect()->route('bahan');
        }
    }
}
