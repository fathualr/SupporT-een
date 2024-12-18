<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function tenagaAhliPendapatan()
    {
        return view('tenagaAhli/pendapatan', [
            "title" => "Pendapatan Tenaga Ahli"
        ]);
    }
    
    public function adminPendapatan()
    {
        return view('admin/pendapatan', [
            "title" => "Pendapatan Admin"
        ]);
    }
}
