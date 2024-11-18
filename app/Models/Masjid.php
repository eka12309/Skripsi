<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;
    protected $table = 'masjid';
    protected $primaryKey = 'id_masjid';
    protected $fillable = [
        'nama_masjid',
        'latitude',
        'longitude',
    ];
}
