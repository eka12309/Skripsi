<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_user',
        'id_seller',
        'id_daftar_qurban',
        'invoice_number',
        'harga',
        'status',
        'alamat_ts',
        'masjid_ts'
    ];
}
