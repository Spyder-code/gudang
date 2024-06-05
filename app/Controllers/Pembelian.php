<?php

namespace App\Controllers;

use App\Models\Produk;
use App\Controllers\BaseController;
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
}