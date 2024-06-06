<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_pembelian';
    protected $primaryKey       = 'no_pembelian';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_pembelian', 'id_bahan', 'harga', 'jumlah', 'total'];

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

    public function getDetailPembelian($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['no_pembelian' => $id]);
        }
    }

    public function getAllData()
    {
        return $this->db->table('detail_pembelian')
                ->join('pembelian', 'pembelian.no_pembelian = detail_pembelian.no_pembelian')
                ->join('bahan', 'bahan.id_bahan = detail_pembelian.id_bahan')
                ->join('mitra', 'mitra.id_mitra = pembelian.id_supplier')
                ->select('detail_pembelian.*, pembelian.tgl, bahan.nama as nama_bahan, mitra.nama as supplier')
                ->orderBy('pembelian.tgl', 'DESC')
                ->get()->getResultArray();
    }
}
