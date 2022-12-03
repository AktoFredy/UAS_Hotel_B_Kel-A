<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'nama_service',
        'id_karyawan',
        'harga_service',
        'status_service'
    ];

        /**
        * Get the karyawan that owns the service
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function karyawan()
        {
            return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
        }
}
