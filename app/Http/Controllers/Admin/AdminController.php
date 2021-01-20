<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}
