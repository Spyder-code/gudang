<?php

namespace App\Controllers;

use App\Models\Produk;
use App\Controllers\BaseController;

class Supplier extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Supplier',
            'pages' => 'Supplier',
        ];

        return view('dashboard/supplier/index', $data);
    }
}