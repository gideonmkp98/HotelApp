<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
      'user',
      'room_charge',
      'is_payed',
      'credit_card'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id','user');
    }

    protected $with = [
        'user',
    ];
}
