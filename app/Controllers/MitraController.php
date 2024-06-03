<?php

namespace App\Controllers;

use App\Models\Mitra;
use App\Controllers\BaseController;

class MitraController extends BaseController
{
    public function index()
    {
        $model = new Mitra();
        // $currentPage = $this->request->getVar('page_mitra') ? $this->request->getVar('page_mitra') : 1;
        // $keyword = $this->request->getVar('keyword');
        // if (empty($keyword)) {
        //     $keyword = '';
        // }
        // $data = [
        //     'title' => 'Mitra',
        //     'keyword' => $keyword,
        // ];
        // $mitra = $model->like('nama', $keyword)->paginate(5, 'mitra');
        // $data['mitra'] = $mitra;
        // $data['pager'] = $model->pager;
        // $data['currentPage'] = $currentPage;

        $data = [
            'title' => 'Mitra',
            'pages' => 'Mitra',
            'mitra' => $model->get()->getResultArray()
        ];

        return view('dashboard/mitra/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tmabah Mitra',
            'pages' => 'Mitra',
        ];
        return view('dashboard/mitra/create', $data);
    }

    public function store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status')
        );

        $model = new Mitra();
        $simpan = $model->insertMitra($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Berhasil Menambah Mitra');
            return redirect()->route('mitra');
        }
    }

    public function edit($id)
    {
        $model = new Mitra();
        $data = [
            'title' => 'Edit Mitra',
            'pages' => 'Mitra',
            'mitra' => $model->getMitra($id)->getRowArray()
        ];

        echo view('dashboard/mitra/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_mitra');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status')
        );

        $model = new Mitra();
        $ubah = $model->updateMitra($data, $id);
        if ($ubah) {
            session()->setFlashdata('info', 'Berhasil Mengedit Mitra');
            return redirect()->route('mitra');
        }
    }
}
