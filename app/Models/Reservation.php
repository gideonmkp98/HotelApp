<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'check_in_date',
        'check_out_date',
        'accepted',
        'number_of_guests'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id','user');
    }

}
