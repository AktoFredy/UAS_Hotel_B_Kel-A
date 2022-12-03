<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_kamar',
        'lama_menginap',
        'status_pembayaran',
        'stat_cekInOrOut',
        'id_karyawan'
    ];

        /**
        * Get the karyawan that owns the bookingOrder
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function karyawan()
        {
            return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
        }

        /**
        * Get the user that owns the bookingOrder
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function user()
        {
            return $this->belongsTo(User::class, 'id_user', 'id');
        }
    
        /**
        * Get the kamar that owns the bookingOrder
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function kamar()
        {
            return $this->belongsTo(Kamar::class, 'id_kamar', 'id');
        }
}
