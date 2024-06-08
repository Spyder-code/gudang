<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\DetailPenjualan;
use App\Models\Penjualan_model;
use App\Models\laporan_model;
use App\Models\Notifikasi;
use App\Models\Produk;

use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;

helper('form');

class Penjualan extends BaseController
{
    protected $penjualanModel;
    protected $laporanModel;
    protected $produkModel;
    protected $detailPenjualan;
    protected $chatModel;
    public function __construct()
    {
        $this->chatModel = new ChatModel();
        $this->penjualanModel = new Penjualan_model();
        $this->laporanModel = new laporan_model();
        $this->produkModel = new Produk();
        $this->detailPenjualan = new DetailPenjualan();
    }

    public function index()
    {
        $model = new Produk();
        $data = [
            'title' => 'Dashboard',
            'pages' => 'Dashboard',
            'terjual' => $this->detailPenjualan->selectSum('jumlah')->first()['jumlah'],
            'transaksi' => $this->penjualanModel->countAll(),
            'total' => $this->penjualanModel->selectSum('total_bayar')->first()['total_bayar'],
        ];

        return view('dashboard/penjualan/index', $data);
    }

    public function view()
    {
        $data = [
            'title' => 'Penjualan',
            'pages' => 'Penjualan',
            'users' => $this->penjualanModel->findAll()
        ];

        return view('dashboard/penjualan/view', $data);
    }

    public function laporan()
    {
        $month = $this->request->getGet('month') ?? date('m');
        $year = $this->request->getGet('year') ?? date('Y');
        $data = [
            'title' => 'Penjualan',
            'pages' => 'Laporan Penjualan',
            'data' => $this->penjualanModel->where('month(tgl)', $month)->where('year(tgl)', $year)->findAll(),
            'month' => $month,
            'year' => $year
        ];

        return view('dashboard/penjualan/laporan', $data);
    }

    public function laporan_cetak()
    {
        $data = [
            'title' => 'Laporan',
            'pages'=> 'Laporan',
        ];

        $month = $this->request->getGet('month') ?? date('m');
        $year = $this->request->getGet('year') ?? date('Y');
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['month'] = $this->request->getGet('month') ?? date('m');
        $data['year'] = $this->request->getGet('year') ?? date('Y');
        $data['data'] = $this->penjualanModel->where('month(tgl)', $month)->where('year(tgl)', $year)->findAll();
        $data['title'] = 'LAPORAN '.$bulan[(int)$data['month']-1].' '.$data['year'];

        $dompdf = new Dompdf();
        $html = view('print/laporan_penjualan',$data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('Laporan Supplier.pdf',['compress'=>true,'Attachment'=>false]);

        // return view('print/laporan_gudang',$data);
    }

    public function coba()
    {
        $data = [
            'title' => 'COBA',
            // Menampilkan daftar user
            'users' => $this->penjualanModel->findAll()
        ];
        return view('penjualan/coba', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Input Penjualan',
            'pages' => 'Penjualan',
            'produk' => $this->produkModel->getProdukAktif()
        ];

        return view('dashboard/penjualan/create', $data);
    }

    public function store()
    {
        $detailPenjualanModel = new DetailPenjualan();
        // masukkan data penjualan dulu baru detail
        $arr = [
            'id_user' => session('id'),
            'total_bayar' => $this->request->getPost('total'),
            'tgl' => $this->request->getPost('tgl'),
            'nama_customer' => $this->request->getPost('nama_customer'),
        ];
        $this->penjualanModel->insert($arr);
        // ambil id terbaru
        $idPenjualan = $this->penjualanModel->ambilIdTerbaru();
        $data = [
            [
                'id_penjualan' => $idPenjualan[0]['id_penjualan'],
                'id_produk' => $this->request->getPost('id_produk'),
                'harga' => $this->request->getPost('harga'),
                'jumlah' => $this->request->getPost('jumlah'),
                'nama_customer' => $this->request->getPost('nama_customer'),
                'total' => $this->request->getPost('total'),
            ]
        ];
        $data2 = [
            'id_penjualan' => $idPenjualan[0]['id_penjualan'],
        ];
        $totalBayar = intval($this->request->getPost('total'));
        $detailPenjualanModel->insertBatch($data);
        $this->penjualanModel->update($data2, ['total_bayar' => strval($totalBayar)]);

        $produk_m = new Produk();
        $produk = $produk_m->find($this->request->getPost('id_produk'));
        $produk_m->update($this->request->getPost('id_produk'), ['jumlah' => $produk['jumlah'] - $this->request->getPost('jumlah')]);
        $insert = [
            'pesan' => $this->request->getPost('jumlah').' Barang Keluar Produk '.$produk['nama'],
            'from' => 'penjualan',
            'to' => 'gudang',
        ];

        $notifikasi = new Notifikasi();
        $notifikasi->insert($insert);
        return redirect()->route('penjualan/view');
    }

    public function detail($id)
    {
        $penjualanModel = new Penjualan_model();
        $detailpenjualanModel = new DetailPenjualan();
        $produkModel = new Produk();
        $data['penjualan'] = $penjualanModel->findAll();
        $data['produk'] = $produkModel->findAll();
        $data['details'] = $detailpenjualanModel->join('produk', 'detail_penjualan.id_produk = produk.id_produk')->where('id_penjualan', $id)->findAll();
        $data['title'] = 'Detail Penjualan';
        $data['pages'] = 'Penjualan';

        return view('dashboard/penjualan/show', $data);
    }

    public function cetakPenjualan()
    {
        $data = [
            'title' => 'cetak Penjualan',
            'users' => $this->penjualanModel->findAll()
        ];
        return view('penjualan/cetakpenjualan', $data);
    }


    // laporan penjualan harian bulanan tahunan
    public function laporanHarian()
    {
        $data = [
            'title' => 'laporan harian',
            'users' => $this->penjualanModel->findAll()
        ];
        return view('penjualan/laporanharian', $data);
    }
    public function viewlaporanHarian()
    {
        $tgl = $this->request->getPost('tgl');
        $data = [
            'dataharian' => $this->laporanModel->DataHarian($tgl),
            'gt' => $this->laporanModel->GrandTotal($tgl),
        ];
        $response = [
            'data' => view('penjualan/tabellaporan', $data),
            'tabel' => $tgl
        ];
        echo json_encode($response);
    }

    public function laporanBulanan()
    {
        $data = [
            'title' => 'laporan bulanan',
            'users' => $this->penjualanModel->findAll()
        ];
        return view('penjualan/laporanbulanan', $data);
    }
    public function viewlaporanBulanan()
    {
        $bln = $this->request->getPost('bln');
        $data = [
            'dataharian' => $this->laporanModel->DataBulanan($bln),
            'gt' => $this->laporanModel->GrandTotalBulanan($bln),
        ];
        $response = [
            'data' => view('penjualan/tabellaporan', $data)
        ];
        echo json_encode($response);
    }

    public function laporanTahunan()
    {
        $data = [
            'title' => 'laporan tahunan',
            'users' => $this->penjualanModel->findAll()
        ];
        return view('penjualan/laporantahunan', $data);
    }
    public function viewlaporanTahunan()
    {
        $thn = $this->request->getPost('thn');
        $data = [
            'dataharian' => $this->laporanModel->DataTahunan($thn),
            'gt' => $this->laporanModel->GrandTotalTahunan($thn),
        ];
        $response = [
            'data' => view('penjualan/tabellaporan', $data)
        ];
        echo json_encode($response);
    }
    // end laporan

    public function storePenjualan()
    {
        $data = array(
            'id_penjualan' => $this->request->getPost('id_penjualan'),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'id_user' => $this->request->getPost('id_user')
        );

        $model = new Penjualan_model();
        $simpan = $model->insertPenjualan($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Berhasil Menambah penjualan');
            return redirect()->to(base_url('penjualan/tampol'));
        }
    }

    public function get_harga_produk()
    {
        $id_produk = $this->request->getPost('id_produk');
        $produkModel = new Produk();
        $produk = $produkModel->find($id_produk);
        $data = [
            'harga' => $produk['biaya_jual'],
            'stok' => $produk['jumlah']
        ];
        return $this->response->setJSON($data);
    }
    //kirim laporan harian bulanan dan tahunan
    public function kirimLaporanharian($tgl)
    {
        // kirim chat ke bos berisi tgl
        $Time =  Time::parse($tgl);
        $messageForBos = '<a href="/penjualan/laporan1/' . $tgl . '" >Laporan Penjualan ' . $tgl . '</a>';
        $this->chatModel->sendMessage(session('id'), 1, $messageForBos);

        session()->setFlashdata('sucessLaporan');

        $data = [
            'title' => 'LAPORAN HARIAN'
        ];

        return view('penjualan/laporanharian', $data);
    }

    public function laporan1($tgl)
    {
        if (session('jabatan') == 'bos' || session('jabatan') == 'penjualan') {


            $data = [
                'title' => 'LAPORAN BOS',
                'tgl' => $tgl
            ];
            return view('penjualan/laporanbosharian', $data);
        }
        return view('dashboard');
    }

    public function kirimLaporanbulanan($bln)
    {
        // kirim chat ke bos berisi bln
        $Time =  Time::parse($bln);
        $messageForBos = '<a href="/penjualan/laporan2/' . $bln . '" >Laporan Penjualan ' . $bln . '</a>';
        $this->chatModel->sendMessage(session('id'), 1, $messageForBos);

        session()->setFlashdata('sucessLaporan');

        $data = [
            'title' => 'LAPORAN BULANAN'
        ];

        return view('penjualan/laporanbulanan', $data);
    }

    public function laporan2($bln)
    {
        if (session('jabatan') == 'bos' || session('jabatan') == 'penjualan') {


            $data = [
                'title' => 'LAPORAN BOS',
                'bln' => $bln
            ];
            return view('penjualan/laporanbosbulanan', $data);
        }
        return view('dashboard');
    }

    public function kirimLaporantahunan($thn)
    {
        // kirim chat ke bos berisi thn
        $Time =  Time::parse($thn);
        $messageForBos = '<a href="/penjualan/laporan3/' . $thn . '" >Laporan Penjualan ' . $thn . '</a>';
        $this->chatModel->sendMessage(session('id'), 1, $messageForBos);

        session()->setFlashdata('sucessLaporan');

        $data = [
            'title' => 'LAPORAN TAHUNAN'
        ];

        return view('penjualan/laporantahunan', $data);
    }

    public function laporan3($thn)
    {
        if (session('jabatan') == 'bos' || session('jabatan') == 'penjualan') {


            $data = [
                'title' => 'LAPORAN BOS',
                'thn' => $thn
            ];
            return view('penjualan/laporanbostahunan', $data);
        }
        return view('dashboard');
    }

    public function produk()
    {
        $model = new Produk();
        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
        $keyword = $this->request->getVar('keyword');
        if (empty($keyword)) {
            $keyword = '';
        }
        $data = [
            'title' => 'Produk',
            'keyword' => $keyword,
        ];
        $produk = $model->like('nama', $keyword)->paginate(5, 'produk');
        $data['produk'] = $produk;
        $data['pager'] = $model->pager;
        $data['currentPage'] = $currentPage;
        return view('penjualan/produk', $data);
    }
}
