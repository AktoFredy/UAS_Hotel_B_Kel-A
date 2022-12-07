<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'kamar_img',
        'tipe_kamar',
        'harga_sewa',
        'kapasitas',
        'lantai'
    ];
     
}
