<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenjualan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'id_produk', 'harga', 'jumlah', 'total'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDetailPenjualan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_penjualan' => $id]);
        }
    }
    

    public function getAllData()
    {
        return $this->db->table('detail_penjualan')
            ->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
            ->join('produk', 'produk.id_produk = detail_penjualan.id_produk')
            ->select('detail_penjualan.*, penjualan.tgl , produk.nama as nama_produk')
            ->orderBy('penjualan.tgl', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getLaporan($month,$year)
    {
        return $this->db->table('detail_penjualan')
            ->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
            ->join('produk', 'produk.id_produk = detail_penjualan.id_produk')
            ->select('detail_penjualan.*, penjualan.tgl , produk.nama as nama_produk')
            ->where('YEAR(penjualan.tgl)', $year)
            ->where('MONTH(penjualan.tgl)', $month)
            ->orderBy('penjualan.tgl', 'DESC')
            ->get()
            ->getResultArray();
    }
}
