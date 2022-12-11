<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket_wisata extends Model
{
    use HasFactory;

    
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'nama_wisata',
        'alamat',
        'harga',
    ];
}
