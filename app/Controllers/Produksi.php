<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DetailPenjahitan;
use App\Models\Penjahitan;
use App\Models\Penjahit;
use App\Models\Bahan;
use App\Models\Notifikasi;
use App\Models\Produk;
use Dompdf\Dompdf;

helper('form');

class Produksi extends BaseController
{
    protected $produkModel;
    protected $bahanModel;
    protected $penjahitModel;
    protected $jahit;
    protected $detailjahit;
    public function __construct()
    {
        $this->produkModel = new Produk();
        $this->bahanModel = new Bahan();
        $this->penjahitModel = new Penjahit();
        $this->jahit = new Penjahitan();
        $this->detailjahit = new DetailPenjahitan();
    }

    public function index()
    {
        $model = new Penjahitan();

        $data = [
            'title' => 'Dashboard',
            'pages' => 'Dashboard',
        ];
        $grafik = $model->getTotalProduksiBatik();
        $data['grafik'] = $grafik;

        return view('dashboard/produksi/index', $data);
    }

    public function tampil()
    {
        $model = new Penjahitan();
        $data = [
            'title' => 'Penjahitan',
            'pages' => 'Penjahitan',
            'data' => $model->getAllData()
        ];
        return view('dashboard/produksi/tampil', $data);
    }

    public function laporan()
    {
        $model = new Penjahitan();
        $month = $this->request->getGet('month') ?? date('m');
        $year = $this->request->getGet('year') ?? date('Y');
        $where = 'YEAR(penjahitan.tgl) = ' . $year . ' AND MONTH(penjahitan.tgl) = ' . $month;
        $data = [
            'title' => 'Laporan Produksi',
            'pages' => 'Laporan Produksi',
            'data' => $model->getAllDataWith($where),
            'month' => $month,
            'year' => $year,
        ];
        return view('dashboard/produksi/laporan', $data);
    }

    public function laporan_cetak()
    {
        $model = new Penjahitan();
        $month = $this->request->getGet('month') ?? date('m');
        $year = $this->request->getGet('year') ?? date('Y');
        $where = 'YEAR(penjahitan.tgl) = ' . $year . ' AND MONTH(penjahitan.tgl) = ' . $month;
        $data = [
            'title' => 'Laporan Produksi',
            'pages' => 'Laporan Produksi',
            'data' => $model->getAllDataWith($where),
            'month' => $month,
            'year' => $year,
        ];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['title'] = 'LAPORAN PRODUKSI PERIODE '. $bulan[$month - 1] . ' ' . $year;

        $dompdf = new Dompdf();
        $html = view('print/laporan_produksi',$data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('Laporan Produksi.pdf',['compress'=>true,'Attachment'=>false]);
    }

    public function detailPenjahitan($id)
    {
        // $penjualanModel = new Penjualan_();
        // $detailpenjualanModel = new DetailPenjualan();
        // $produkModel = new Produk();
        $data['penjahitan'] = $this->jahit->findAll();
        // $data['produk'] = $produkModel->findAll();
        $data['details'] = $this->detailjahit->where('no_penjahitan', $id)->findAll();

        $data['title'] = 'detail';

        return view('produksi/detailpenjahitan', $data);
    }

    public function tambahProduksi()
    {
        $data = [
            'title' => 'Input Produksi',
            'pages' => 'Produksi',
            'produk' => $this->produkModel->getProdukAktif(),
            'bahan' => $this->bahanModel->getBahanAktif(),
            'penjahit' => $this->penjahitModel->getPenjahitAktif(),
        ];
        return view('dashboard/produksi/create', $data);
    }

    public function storeProduksi()
    {
        $data = array(
            'no_penjahitan' => $this->request->getPost('no_penjahitan'),
            'id_penjahit' => $this->request->getPost('id_penjahit'),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'id_bahan' => $this->request->getPost('id_bahan'),
            'total_bahan' => $this->request->getPost('total_bahan'),
            'id_user' => $this->request->getPost('id_user')
        );
        // var_dump($data);

        $model = new Penjahitan();
        $bahanModel = new Bahan();
        $simpan = $model->insertPenjahitan($data);
        if ($simpan) {
            $bahan = $bahanModel->find($this->request->getPost('id_bahan'));
            $bahanModel->update($this->request->getPost('id_bahan'), ['jumlah' => $bahan['jumlah'] - $this->request->getPost('total_bahan')]);
            $this->storeDetailProduksi();
            session()->setFlashdata('success', 'Berhasil Menambah Produksi');
            return redirect()->to(base_url('produksi/tampil'));
        }
    }

    public function storeDetailProduksi()
    {
        $detailPenjahitanModel = new DetailPenjahitan();
        $noPenjahitan = $this->jahit->ambilIdTerbaru();
        $data = [
            [
                'no_penjahitan' => $noPenjahitan[0]['no_penjahitan'],
                'id_produk' => $this->request->getPost('id_produk'),
                'ukuran' => $this->request->getPost('ukuran'),
                'jumlah' => $this->request->getPost('jumlah'),
                'jumlah_bahan' => $this->request->getPost('jumlah_bahan'),
                'biaya_produksi' => $this->request->getPost('biaya_produksi'),
            ]
        ];
        $data2 = [
            'no_penjahitan' => $noPenjahitan[0]['no_penjahitan'],
        ];
        // var_dump($this->request->getPost('jumlah_bahan'));
        $totalBayar = intval($this->request->getPost('biaya_produksi'));
        $detailPenjahitanModel->insertBatch($data);
        $this->jahit->update($data2, ['total_bayar' => strval($totalBayar)]);
    }
    public function get_harga_produk()
    {
        $id_produk = $this->request->getPost('id_produk');
        $produkModel = new Produk();
        $produk = $produkModel->find($id_produk);

        $data = [
            'harga' => $produk['biaya_produksi'],
            'stok' => $produk['jumlah'],
            'ukuran' => $produk['ukuran'],
        ];

        return $this->response->setJSON($data);
    }
    public function get_jumlah_bahan()
    {
        $id_bahan = $this->request->getPost('id_bahan');
        $bahanModel = new Bahan();
        $bahan = $bahanModel->find($id_bahan);

        $data = [
            // 'harga' => $bahan['biaya_bahansi'],
            'stokbahan' => $bahan['jumlah'],
            // 'ukuran' => $bahan['ukuran'],
        ];

        return $this->response->setJSON($data);
    }

    public function ajukan_bahan($id)
    {
        $bahan = new Bahan();
        $bahan = $bahan->find($id);

        $insert = [
            'pesan' => 'Pengajuan pembelian bahan '.$bahan['nama'],
            'from' => 'produksi',
            'to' => 'supplier',
        ];

        $notifikasi = new Notifikasi();
        $notifikasi->insert($insert);

        session()->setFlashdata('success', 'Pengajuan berhasil!');
        return redirect()->to(base_url('bahan'));
    }
}
