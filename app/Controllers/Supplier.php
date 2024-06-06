<?php

namespace App\Controllers;

use App\Models\Produk;
use App\Controllers\BaseController;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use Dompdf\Dompdf;

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

    public function laporan()
    {
        $model = new Pembelian();
        $data = [
            'data' => $model->getAllData(), 
            'title' => 'Laporan Pembelian',
            'pages'=> 'Laporan Supplier',
        ];

        $data['month'] = $this->request->getGet('month') ?? date('m');
        $data['year'] = $this->request->getGet('year') ?? date('Y');
        $data['data'] = $model->getLaporan($data['month'], $data['year']);

        return view('dashboard/pembelian/laporan',$data);
    }

    public function laporan_cetak()
    {
        $model = new Pembelian();
        $data = [
            'data' => $model->getAllData(), 
            'title' => 'Laporan',
            'pages'=> 'Laporan',
        ];

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['month'] = $this->request->getGet('month') ?? date('m');
        $data['year'] = $this->request->getGet('year') ?? date('Y');
        $data['data'] = $model->getLaporan($data['month'], $data['year']);
        $data['title'] = 'Laporan '.$bulan[(int)$data['month']-1].' '.$data['year'];

        $dompdf = new Dompdf();
        $html = view('print/laporan_supplier',$data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('Laporan Supplier.pdf',['compress'=>true,'Attachment'=>false]);

        // return view('print/laporan_gudang',$data);
    }
}