<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type',
        'number_of_beds'
    ];

    public function room_type() {
        return $this->hasOne(RoomCategory::class, 'id','room_type');
    }

    protected $with = [
        'room_type',
    ];
}
