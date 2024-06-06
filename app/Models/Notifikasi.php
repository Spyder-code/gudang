<?php

namespace App\Models;

use CodeIgniter\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'pesan', 'tanggal',' is_read', 'from', 'to'];

    public function update_is_read($to)
    {
        $this->db->table($this->table)->where('to', $to)->update(['is_read' => 1]);
    }
}