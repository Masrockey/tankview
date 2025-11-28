<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use Illuminate\Http\Request;

class TankPrintController extends Controller
{
    public function print(Tank $tank)
    {
        return view('tanks.print', compact('tank'));
    }
}