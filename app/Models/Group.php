<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = "group";
    protected $primaryKey = "id_group";
    protected $fillable = [
        'tipe_hewan', 
        'penjual', 
        'pendaftar',
    ];
    protected $casts = [
        'pendaftar' => 'array',
    ];
}
