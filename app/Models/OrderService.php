<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_booking',
        'id_service',
        'status_pembayaran',
    ];

    /**
        * Get the menu that owns the OrderFOB
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
        public function service()
        {
            return $this->belongsTo(Service::class, 'id_service', 'id');
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
