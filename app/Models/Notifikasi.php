<?php

namespace App\Models;

use CodeIgniter\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'pesan', 'tanggal',' is_read', 'role'];
}