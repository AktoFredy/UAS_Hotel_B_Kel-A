<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFob extends Model
{
    use HasFactory;
    
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_booking',
        'id_menu',
        'status_pembayaran',
        'jumlah',
        'total'
    ];
    
        /**
        * Get the menu that owns the OrderFOB
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function fob()
        {
            return $this->belongsTo(Fob::class, 'id_menu', 'id');
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
