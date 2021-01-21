<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'phone',
        'streetname',
        'postal_code',
        'city',
        'country',
        'active'
    ];

    protected $dates = ['date_of_birth'];

    public function user() {
        return $this->hasOne(User::class, 'id','user_id');
    }

    protected $with = [
        'user',
    ];
}
