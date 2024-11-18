<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qurban extends Model
{
    use HasFactory;
    protected $table = 'daftar_qurban';
    protected $primaryKey = 'id_daftar_qurban';
    protected $fillable = [
        'id_user',
        'id_seller',
        'status_pembayaran',
        'snap_token',
        'tipe_qurban',
        'no_hp',
        'alamat',
        'masjid',
        'latitude',
        'longitude'
    ];
}
