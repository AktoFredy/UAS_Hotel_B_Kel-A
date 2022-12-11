<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orwis extends Model
{
    use HasFactory;

    
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_booking',
        'id_wisata',
        'status_pembayaran',
        'supir',
        'kendaraan',
    ];
    
        /**
        * Get the menu that owns the OrderFOB
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function paket_wisata()
        {
            return $this->belongsTo(paket_wisata::class, 'id_wisata', 'id');
        }

        /**
        * Get the booking that owns the OrderFOB
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function booking()
        {
            return $this->belongsTo(Booking::class, 'id_booking', 'id');
        }
}
