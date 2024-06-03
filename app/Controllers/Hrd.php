<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class Hrd extends BaseController
{
    protected $userModel;
    protected $penggajian;
    protected $presensiModel;
    public function __construct()
    {
        $this->userModel = new \App\Models\User();
        $this->penggajian = new \App\Controllers\Penggajian();
        $this->presensiModel = new \App\Models\presensiModel();
    }

    public function index()
    {
        if (session('jabatan') != 'hrd') return redirect()->to('/dashboard');

        $totalUser = $this->userModel->countAll();

        $penggajian = $this->penggajian->hitungGaji();

        $absensi = $this->presensiModel->where('tanggal_presensi', date('Y-m-d'))->findAll();

        foreach ($penggajian as $p) {
            foreach ($absensi as $a) {
                if ($p['id_pegawai'] == $a['id_pegawai']) {
                    $penggajian[$p['id_pegawai']]['info']   = $a['info'];
                } else {
                    $penggajian[$p['id_pegawai']]['info']   = 'belum absen';
                }
            }
        }
        // dd($absensi);

        $data = [
            'title' => 'Dashboard',
            'pages' => 'Dashboard',
            'totalUser' => $totalUser,
            'penggajian' => $penggajian,
        ];

        return view('dashboard/hrd/index', $data);
    }
}
