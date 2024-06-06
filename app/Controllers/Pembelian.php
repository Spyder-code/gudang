<?php

namespace App\Controllers;

use App\Models\Produk;
use App\Controllers\BaseController;
use App\Models\Bahan;
use App\Models\DetailPembelian;
use App\Models\Mitra;
use App\Models\Pembelian as ModelsPembelian;

class Pembelian extends BaseController
{
    public function index()
    {
        $model = new ModelsPembelian();
        $data = [
            'title' => 'Pembelian',
            'pages' => 'Pembelian',
        ];

        $data['data'] = $model->getAllData();

        return view('dashboard/pembelian/index', $data);
    }

    public function create()
    {
        $bahanModel = new Bahan();
        $supplierModel = new Mitra();
        $data = [
            'title' => 'Pembelian',
            'pages' => 'Pembelian',
        ];

        $data['bahan'] = $bahanModel->findAll();
        $data['mitra'] = $supplierModel->findAll();

        return view('dashboard/pembelian/create', $data);
    }
    
    public function edit($id)
    {
        $bahanModel = new Bahan();
        $supplierModel = new Mitra();
        $pembelianModel = new ModelsPembelian();
        $detailPembelianModel = new DetailPembelian();
        $data = [
            'title' => 'Pembelian',
            'pages' => 'Pembelian',
        ];

        $data['bahan'] = $bahanModel->findAll();
        $data['mitra'] = $supplierModel->findAll();
        $data['pembelian'] = $pembelianModel->find($id);
        $data['pembelian_bahan'] = $detailPembelianModel->where('no_pembelian', $id)->find()[0];

        return view('dashboard/pembelian/edit', $data);
    }

    public function store()
    {
        $model = new ModelsPembelian();
        $data = [
            'id_user' => session()->get('id'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tgl' => $this->request->getPost('tgl'),
            'total_bayar' => $this->request->getPost('total'),
        ];

        $detail = new DetailPembelian();
        $pembelian = $model->insert($data);
        $data = [
            'no_pembelian' => $pembelian,
            'id_bahan' => $this->request->getPost('id_bahan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'total' => $this->request->getPost('total'),
        ];
        $detail->insert($data);

        $bahanModel = new Bahan();
        $bahan = $bahanModel->find($this->request->getPost('id_bahan'));
        $bahanModel->update($this->request->getPost('id_bahan'), [
            'jumlah' => $bahan['jumlah'] + $this->request->getPost('jumlah')
        ]);

        session()->setFlashdata('success', 'Pembelian berhasil disimpan!');
        return redirect()->to('/pembelian');
    }
    
    public function update($id)
    {
        $model = new ModelsPembelian();
        $data = [
            'id_user' => session()->get('id'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tgl' => $this->request->getPost('tgl'),
            'total_bayar' => $this->request->getPost('total'),
        ];

        $detail = new DetailPembelian();
        $model->find($id);
        $model->update($id, $data);

        $data = [
            'id_bahan' => $this->request->getPost('id_bahan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'total' => $this->request->getPost('total'),
        ];
        $detailPembelian = $detail->find($id);
        $detail->update($id, $data);

        $bahanModel = new Bahan();
        $bahan = $bahanModel->find($this->request->getPost('id_bahan'));
        $bahanModel->update($this->request->getPost('id_bahan'), [
            'jumlah' =>( $bahan['jumlah'] + $this->request->getPost('jumlah')) - $detailPembelian['jumlah']
        ]);

        session()->setFlashdata('success', 'Pembelian berhasil disimpan!');
        return redirect()->to('/pembelian');
    }
}