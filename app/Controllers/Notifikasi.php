<?php

namespace App\Controllers;

use App\Models\Notifikasi as NotifikasiModel;
use App\Controllers\BaseController;

class Notifikasi extends BaseController
{
    public function index()
    {
        $model = new NotifikasiModel();
        $data = [
            'title' => 'Notifikasi',
            'pages' => 'Notifikasi',
        ];
        
        
        $data['data'] = $model->where('to', session()->get('jabatan'))->orderBy('tanggal', 'DESC')->findAll();
        
        $model->update_is_read(session()->get('jabatan'));
        return view('dashboard/notifikasi/index', $data);
    }
}