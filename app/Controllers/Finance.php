<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pembelian;
use App\Models\PenjualanModel;

class Finance extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'pages' => 'Dashboard'
        ];

        $pemasukan_model = new PenjualanModel();
        $pengeluaran_model = new Pembelian();
        $pemasukan = [];
        $pengeluaran = [];
        for ($i = 1; $i <= 12; $i++) {
            $pemasukan[] = $pemasukan_model->where('MONTH(tgl)', $i)->where('YEAR(tgl)', date('Y'))->selectSum('total_bayar')->first()['total_bayar'] ?? 0;
            $pengeluaran[] = $pengeluaran_model->where('MONTH(tgl)', $i)->where('YEAR(tgl)', date('Y'))->selectSum('total_bayar')->first()['total_bayar'] ?? 0;
        }

        $data['pemasukan'] = $pemasukan;
        $data['pengeluaran'] = $pengeluaran;

        return view('dashboard/finance/index', $data);
    }
}
