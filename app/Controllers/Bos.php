<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Bahan;
use App\Models\GrafikModelBos;
use App\Models\Mitra;
use App\Models\Penjahit;
use App\Models\Produk;

class Bos extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('finance'));
    }

    public function penjualangraphic_1hari()
    {
        $model = new Produk();
        $modelGrafik = new GrafikModelBos();

        $data = [
            'title' => 'Dashboard Bos'
        ];

        $data['cekPenjualan1Hari'] = $modelGrafik->cekPenjualan1Hari();
        $data['grafik1hariA'] = $modelGrafik->getTotalPenjualan1Hari();
        $data['grafik1hariB'] = $modelGrafik->getTotalPendapatan1Hari();;
        $data['grafik1hariC'] = $modelGrafik->getNamaProduk1Hari();
        $data['Rp1hari'] = $modelGrafik->getRpPendapatan1Hari();
        $data['Qty1hari'] = $modelGrafik->getTotalTerjual1Hari();

        return view('dashboard/bos/penjualan_graphic/1hari', $data);
    }

    public function penjualangraphic_7hari()
    {
        $model = new Produk();
        $modelGrafik = new GrafikModelBos();

        $data = [
            'title' => 'Dashboard Bos'
        ];

        $data['cekPenjualan7Hari'] = $modelGrafik->cekPenjualan7Hari();
        $data['grafik7hariA'] = $modelGrafik->getTotalPenjualan7Hari();
        $data['grafik7hariB'] = $modelGrafik->getTotalPendapatan7Hari();;
        $data['grafik7hariC'] = $modelGrafik->getNamaProduk7Hari();
        $data['Rp7hari'] = $modelGrafik->getRpPendapatan7Hari();
        $data['Qty7hari'] = $modelGrafik->getTotalTerjual7Hari();

        return view('dashboard/bos/penjualan_graphic/7hari', $data);
    }

    public function penjualangraphic_90hari()
    {
        $model = new Produk();
        $modelGrafik = new GrafikModelBos();

        $data = [
            'title' => 'Dashboard Bos'
        ];

        $data['cekPenjualan90Hari'] = $modelGrafik->cekPenjualan90Hari();
        $data['grafik90hariA'] = $modelGrafik->getTotalPenjualan90Hari();
        $data['grafik90hariB'] = $modelGrafik->getTotalPendapatan90Hari();;
        $data['grafik90hariC'] = $modelGrafik->getNamaProduk90Hari();
        $data['Rp90hari'] = $modelGrafik->getRpPendapatan90Hari();
        $data['Qty90hari'] = $modelGrafik->getTotalTerjual90Hari();;

        return view('dashboard/bos/penjualan_graphic/90hari', $data);
    }

    public function penjualangraphic_tahunan()
    {
        $model = new Produk();
        $modelGrafik = new GrafikModelBos();

        $data = [
            'title' => 'Dashboard Bos'
        ];

        $grafikTahunanA = $model->getTotalPenjualanTahunan();
        $grafikTahunanB = $model->getTotalPendapatanTahunan();
        $grafikTahunanC = $model->getNamaProdukTahunan();
        $Rptahunan = $model->getRpPendapatanTahunan();
        $Qtytahunan = $model->getTotalTerjualTahunan();

        $data['grafiktahunanA'] = $grafikTahunanA;
        $data['grafiktahunanB'] = $grafikTahunanB;
        $data['grafiktahunanC'] = $grafikTahunanC;
        $data['Rptahunan'] = $Rptahunan['total']; // Ambil nilai total dari array hasil query
        $data['Qtytahunan'] = $Qtytahunan['jumlah']; // Ambil nilai jumlah dari array hasil query

        return view('dashboard/bos/penjualan_graphic/tahunan', $data);
    }

    // Mulai pilihan grafik
    public function detailGrafikPenjualan()
    {
        $modelgrafik = new GrafikModelBos();
        $data = [
            'title' => 'Detail Grafik Penjualan',
            'pilihtahun' => $modelgrafik->thn(),
        ];
        return view('bos/grafikpenj1', $data);
    }

    public function detailGrafikPenjahit()
    {
        $modelgrafik = new GrafikModelBos();
        $data = [
            'title' => 'Detail Grafik Penjahit',
            'pilihtahun' => $modelgrafik->thnPenjahit(),
        ];
        return view('bos/grafikpenjahit', $data);
    }

    public function detailGrafikMitra()
    {
        $modelgrafik = new GrafikModelBos();
        $data = [
            'title' => 'Detail Grafik Mitra',
            'pilihtahun' => $modelgrafik->thnMitra(),
        ];
        return view('bos/grafikmitra', $data);
    }

    public function detailGrafikPenjahitan()
    {
        $modelgrafik = new GrafikModelBos();
        $data = [
            'title' => 'Detail Grafik Penjahitan',
            'pilihtahun' => $modelgrafik->thnPenjahitan(),
        ];
        return view('bos/grafikpenjahitan', $data);
    }

    public function detailGrafikPembelian()
    {
        $modelgrafik = new GrafikModelBos();
        $data = [
            'title' => 'Detail Grafik Pembelian',
            'pilihtahun' => $modelgrafik->thnPembelian(),
        ];
        return view('bos/grafikpembelian', $data);
    }

    // Mulai Harian
    public function viewDetailGrafikPenjahitanHarian()
    {
        $modelgrafik = new GrafikModelBos();
        $tgl = $this->request->getPost('tgl');
        $info = "tanggal";
        $data = [
            'cekpenjahitanperwaktu' => $modelgrafik->getInfoPerHariPenjahitan($tgl),
            'datagrafik' => $modelgrafik->getTotalPenjahitanProdukPerHari($tgl),
            'totalproduk' => $modelgrafik->getTotalProdukDihasilkanPerHari($tgl),
            'datagrafik2' => $modelgrafik->getTotalPenjahitanBahanPerHari($tgl),
            'totalbahan' => $modelgrafik->getTotalBahanDigunakanPerHari($tgl),
            'datagrafik3' => $modelgrafik->getTotalPengeluaranPenjahitanPerHari($tgl),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPenjahitanPerHari($tgl),
            'datagrafik4' => $modelgrafik->getNamaPenjahitanProdukPerHari($tgl),
            'datagrafik5' => $modelgrafik->getNamaPenjahitanBahanPerHari($tgl),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahitan', $data)
        ];
        echo json_encode($response);
    }
    public function viewDetailGrafikPembelianHarian()
    {
        $modelgrafik = new GrafikModelBos();
        $tgl = $this->request->getPost('tgl');
        $info = "tanggal";
        $data = [
            'cekpembelianperwaktu' => $modelgrafik->getInfoPerHariPembelian($tgl),
            'datagrafik' => $modelgrafik->getTotalPembelianPerHari($tgl),
            'totalproduk' => $modelgrafik->getTotalDibeliPerHari($tgl),
            'datagrafik2' => $modelgrafik->getTotalPengeluaranPembelianPerHari($tgl),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPembelianPerHari($tgl),
            'datagrafik3' => $modelgrafik->getNamaBahanPerHari($tgl),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpembelian', $data)
        ];
        echo json_encode($response);
    }
    public function viewDetailGrafikPenjualanHarian()
    {
        $modelgrafik = new GrafikModelBos();
        $tgl = $this->request->getPost('tgl');
        $info = "tanggal";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerHari($tgl),
            'datagrafik' => $modelgrafik->getTotalPenjualanPerHari($tgl),
            'totalproduk' => $modelgrafik->getTotalTerjualPerHari($tgl),
            'datagrafik2' => $modelgrafik->getTotalPendapatanPerHari($tgl),
            'totalpendapatan' => $modelgrafik->getRpPendapatanPerHari($tgl),
            'datagrafik3' => $modelgrafik->getNamaProdukPerHari($tgl),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafik', $data)
        ];
        echo json_encode($response);
    }
    public function viewDetailGrafikPenjahitHarian()
    {
        $modelgrafik = new GrafikModelBos();
        $tgl = $this->request->getPost('tgl');
        $info = "tanggal";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerHariPenjahit($tgl),
            'datagrafik' => $modelgrafik->getJumlahProdukPenjahitPerHari($tgl),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahit', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikMitraHarian()
    {
        $modelgrafik = new GrafikModelBos();
        $tgl = $this->request->getPost('tgl');
        $info = "tanggal";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerHariMitra($tgl),
            'datagrafik' => $modelgrafik->getJumlahPembelianMitraPerHari($tgl),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikmitra', $data)
        ];
        echo json_encode($response);
    }

    // Mulai Bulanan
    public function viewDetailGrafikPenjualanBulanan()
    {
        $modelgrafik = new GrafikModelBos();
        $bln = $this->request->getPost('bln');
        $info = "bulan";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerBulan($bln),
            'datagrafik' => $modelgrafik->getTotalPenjualanPerBulan($bln),
            'totalproduk' => $modelgrafik->getTotalTerjualPerBulan($bln),
            'datagrafik2' => $modelgrafik->getTotalPendapatanPerBulan($bln),
            'totalpendapatan' => $modelgrafik->getRpPendapatanPerBulan($bln),
            'datagrafik3' => $modelgrafik->getNamaProdukPerBulan($bln),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafik', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPenjahitanBulanan()
    {
        $modelgrafik = new GrafikModelBos();
        $bln = $this->request->getPost('bln');
        $info = "bulan";
        $data = [
            'cekpenjahitanperwaktu' => $modelgrafik->getInfoPerBulanPenjahitan($bln),
            'datagrafik' => $modelgrafik->getTotalPenjahitanProdukPerBulan($bln),
            'totalproduk' => $modelgrafik->getTotalProdukDihasilkanPerBulan($bln),
            'datagrafik2' => $modelgrafik->getTotalPenjahitanBahanPerBulan($bln),
            'totalbahan' => $modelgrafik->getTotalBahanDigunakanPerBulan($bln),
            'datagrafik3' => $modelgrafik->getTotalPengeluaranPenjahitanPerBulan($bln),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPenjahitanPerBulan($bln),
            'datagrafik4' => $modelgrafik->getNamaPenjahitanProdukPerBulan($bln),
            'datagrafik5' => $modelgrafik->getNamaPenjahitanBahanPerBulan($bln),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahitan', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPembelianBulanan()
    {
        $modelgrafik = new GrafikModelBos();
        $bln = $this->request->getPost('bln');
        $info = "bulan";
        $data = [
            'cekpembelianperwaktu' => $modelgrafik->getInfoPerBulanPembelian($bln),
            'datagrafik' => $modelgrafik->getTotalPembelianPerBulan($bln),
            'totalproduk' => $modelgrafik->getTotalDibeliPerBulan($bln),
            'datagrafik2' => $modelgrafik->getTotalPengeluaranPembelianPerBulan($bln),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPembelianPerBulan($bln),
            'datagrafik3' => $modelgrafik->getNamaBahanPerBulan($bln),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpembelian', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPenjahitBulanan()
    {
        $modelgrafik = new GrafikModelBos();
        $bln = $this->request->getPost('bln');
        $info = "bulan";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerBulanPenjahit($bln),
            'datagrafik' => $modelgrafik->getJumlahProdukPenjahitPerBulan($bln),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahit', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikMitraBulanan()
    {
        $modelgrafik = new GrafikModelBos();
        $bln = $this->request->getPost('bln');
        $info = "bulan";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerBulanMitra($bln),
            'datagrafik' => $modelgrafik->getJumlahPembelianMitraPerBulan($bln),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikmitra', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPenjualanTahunan()
    {
        $modelgrafik = new GrafikModelBos();
        $thn = $this->request->getPost('thn');
        $info = "tahun";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerTahun($thn),
            'datagrafik' => $modelgrafik->getTotalPenjualanPerTahun($thn),
            'totalproduk' => $modelgrafik->getTotalTerjualPerTahun($thn),
            'datagrafik2' => $modelgrafik->getTotalPendapatanPerTahun($thn),
            'totalpendapatan' => $modelgrafik->getRpPendapatanPerTahun($thn),
            'datagrafik3' => $modelgrafik->getNamaProdukPerTahun($thn),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafik', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPenjahitanTahunan()
    {
        $modelgrafik = new GrafikModelBos();
        $thn = $this->request->getPost('thn');
        $info = "tahun";
        $data = [
            'cekpenjahitanperwaktu' => $modelgrafik->getInfoPerTahunPenjahitan($thn),
            'datagrafik' => $modelgrafik->getTotalPenjahitanProdukPerTahun($thn),
            'totalproduk' => $modelgrafik->getTotalProdukDihasilkanPerTahun($thn),
            'datagrafik2' => $modelgrafik->getTotalPenjahitanBahanPerTahun($thn),
            'totalbahan' => $modelgrafik->getTotalBahanDigunakanPerTahun($thn),
            'datagrafik3' => $modelgrafik->getTotalPengeluaranPenjahitanPerTahun($thn),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPenjahitanPerTahun($thn),
            'datagrafik4' => $modelgrafik->getNamaPenjahitanProdukPerTahun($thn),
            'datagrafik5' => $modelgrafik->getNamaPenjahitanBahanPerTahun($thn),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahitan', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPembelianTahunan()
    {
        $modelgrafik = new GrafikModelBos();
        $thn = $this->request->getPost('thn');
        $info = "tahun";
        $data = [
            'cekpembelianperwaktu' => $modelgrafik->getInfoPerTahunPembelian($thn),
            'datagrafik' => $modelgrafik->getTotalPembelianPerTahun($thn),
            'totalproduk' => $modelgrafik->getTotalDibeliPerTahun($thn),
            'datagrafik2' => $modelgrafik->getTotalPengeluaranPembelianPerTahun($thn),
            'totalpendapatan' => $modelgrafik->getRpPengeluaranPembelianPerTahun($thn),
            'datagrafik3' => $modelgrafik->getNamaBahanPerTahun($thn),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpembelian', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikPenjahitTahunan()
    {
        $modelgrafik = new GrafikModelBos();
        $thn = $this->request->getPost('thn');
        $info = "tahun";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerTahunPenjahit($thn),
            'datagrafik' => $modelgrafik->getJumlahProdukPenjahitPerTahun($thn),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikpenjahit', $data)
        ];
        echo json_encode($response);
    }

    public function viewDetailGrafikMitraTahunan()
    {
        $modelgrafik = new GrafikModelBos();
        $thn = $this->request->getPost('thn');
        $info = "tahun";
        $data = [
            'cekpenjualanperwaktu' => $modelgrafik->getInfoPerTahunMitra($thn),
            'datagrafik' => $modelgrafik->getJumlahPembelianMitraPerTahun($thn),
            'info' => $info
        ];
        $response = [
            'data' => view('bos/hasilgrafikmitra', $data)
        ];
        echo json_encode($response);
    }
}
