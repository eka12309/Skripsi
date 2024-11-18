<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $table = 'seller';
    protected $primaryKey = 'id_seller';
    protected $fillable = [
        'id_user',
        'tipe_hewan',
        'umur_qurban',
        'alamat',
        'no_hp',
        'harga',
        'harga_per_orang',
        'quota',
        'latitude',
        'longitude'
    ];
}
