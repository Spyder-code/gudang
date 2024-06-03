<?php

namespace App\Controllers;

use App\Models\Produk;
use App\Controllers\BaseController;

class ProdukController extends BaseController
{
    public function index()
    {
        $model = new Produk();
        // $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
        // $keyword = $this->request->getVar('keyword');
        // if (empty($keyword)) {
        //     $keyword = '';
        // }
        // $produk = $model->like('nama', $keyword)->paginate(5, 'produk');

        // $data = [
        //     'title' => 'Produk',
        //     'keyword' => $keyword,
        // ];
        // $data['produk'] = $produk;
        // $data['pager'] = $model->pager;
        // $data['currentPage'] = $currentPage;

        $data = [
            'title' => 'Produk',
            'pages' => 'Produk',
            'produk' => $model->orderBy('jumlah')->get()->getResultArray()
        ];

        return view('dashboard/produk/index', $data);
    }

    public function show($id)
    {
        $model = new Produk();
        $data = [
            'title' => 'Detail Produk',
            'pages' => 'Produk',
            'produk' => $model->getProduk($id)->getRowArray()
        ];

        return view('dashboard/produk/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'pages' => 'Produk',
        ];
        return view('dashboard/produk/create', $data);
    }

    public function store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'ukuran' => $this->request->getPost('ukuran'),
            'biaya_produksi' => $this->request->getPost('biaya_produksi'),
            'biaya_jual' => $this->request->getPost('biaya_jual'),
            'jumlah_produksi_perkain' => $this->request->getPost('jumlah_produksi_perkain'),
            'panjang_kain_perproduksi' => $this->request->getPost('panjang_kain_perproduksi'),
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status')
        );

        $model = new Produk();
        $simpan = $model->insertProduk($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Berhasil Menambah produk');
            return redirect()->route('produk');
        }
    }

    public function edit($id)
    {
        $model = new Produk();
        $data = [
            'title' => 'Edit Produk',
            'pages' => 'Produk',
            'produk' => $model->getProduk($id)->getRowArray()
        ];

        return view('dashboard/produk/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_produk');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'ukuran' => $this->request->getPost('ukuran'),
            'biaya_produksi' => $this->request->getPost('biaya_produksi'),
            'biaya_jual' => $this->request->getPost('biaya_jual'),
            // 'jumlah' => $this->request->getPost('jumlah'),
            'jumlah_produksi_perkain' => $this->request->getPost('jumlah_produksi_perkain'),
            'panjang_kain_perproduksi' => $this->request->getPost('panjang_kain_perproduksi'),
            'status' => $this->request->getPost('status')
        );

        $model = new Produk();
        $ubah = $model->updateProduk($data, $id);
        if ($ubah) {
            session()->setFlashdata('info', 'Berhasil Mengedit produk');
            return redirect()->route('produk');
        }
    }
}
