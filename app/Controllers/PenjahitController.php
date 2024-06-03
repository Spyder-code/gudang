<?php

namespace App\Controllers;

use App\Models\Penjahit;
use App\Controllers\BaseController;

class PenjahitController extends BaseController
{
    public function index()
    {
        $model = new Penjahit();
        // $currentPage = $this->request->getVar('page_penjahit') ? $this->request->getVar('page_penjahit') : 1;
        // $keyword = $this->request->getVar('keyword');
        // if (empty($keyword)) {
        //     $keyword = '';
        // }
        // $data = [
        //     'title' => 'Penjahit',
        //     'keyword' => $keyword,
        // ];
        // $penjahit = $model->like('nama', $keyword)->paginate(5, 'penjahit');
        // $data['penjahit'] = $penjahit;
        // $data['pager'] = $model->pager;
        // $data['currentPage'] = $currentPage;

        $data = [
            'title' => 'Penjahit',
            'pages' => 'Penjahit',
            'penjahit' => $model->get()->getResultArray()
        ];

        return view('dashboard/penjahit/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tmabah Penjahit',
            'pages' => 'Penjahit',
        ];
        return view('dashboard/penjahit/create', $data);
    }

    public function store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status')
        );

        $model = new Penjahit();
        $simpan = $model->insertPenjahit($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Berhasil Menambah Penjahit');
            return redirect()->route('penjahit');
        }
    }

    public function edit($id)
    {
        $model = new Penjahit();
        $data = [
            'title' => 'Edit Penjahit',
            'pages' => 'Penjahit',
        ];
        $data['penjahit'] = $model->getPenjahit($id)->getRowArray();
        echo view('dashboard/penjahit/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_penjahit');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status')
        );
        $model = new Penjahit();
        $ubah = $model->updatePenjahit($data, $id);
        if ($ubah) {
            session()->setFlashdata('info', 'Berhasil Mengedit Penjahit');
            return redirect()->route('penjahit');
        }
    }
}
