<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
      'reservation_id',
      'room_charge',
      'is_payed',
      'credit_card'
    ];

    public function reservation() {
        return $this->hasOne(Reservation::class, 'id','reservation_id');
    }

    protected $with = [
        'reservation',
    ];
}
