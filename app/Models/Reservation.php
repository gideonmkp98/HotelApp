<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'accepted',
        'number_of_guests'
    ];

    protected $dates = ['check_in_date', 'check_out_date'];

    public function guest() {
        return $this->hasOne(Guest::class, 'id','guest_id');
    }

    public function room() {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    protected $with = [
        'guest',
        'room',
    ];
}
