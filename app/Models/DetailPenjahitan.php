<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenjahitan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_jahit';
    protected $primaryKey       = 'no_penjahitan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_penjahitan', 'id_produk', 'ukuran', 'jumlah', 'jumlah_bahan', 'biaya_produksi'];

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

    public function getDetailPenjahitan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['no_penjahitan' => $id]);
        }
    }

    public function getAllData()
    {
        return $this->db->table('detail_jahit')
                ->join('penjahitan', 'penjahitan.no_penjahitan = detail_jahit.no_penjahitan')
                ->join('produk', 'produk.id_produk = detail_jahit.id_produk')
                ->select('detail_jahit.*, produk.nama as nama_produk, penjahitan.tgl as tgl_penjahitan')
                ->orderBy('penjahitan.tgl', 'DESC')
                ->get()->getResultArray();
    }
    
    public function getLaporan($month, $year)
    {
        return $this->db->table('detail_jahit')
                ->join('penjahitan', 'penjahitan.no_penjahitan = detail_jahit.no_penjahitan')
                ->join('produk', 'produk.id_produk = detail_jahit.id_produk')
                ->select('detail_jahit.*, produk.nama as nama_produk, penjahitan.tgl as tgl_penjahitan')
                ->where('month(penjahitan.tgl)', $month)
                ->where('year(penjahitan.tgl)', $year)
                ->orderBy('penjahitan.tgl', 'DESC')
                ->get()->getResultArray();
    }
}
