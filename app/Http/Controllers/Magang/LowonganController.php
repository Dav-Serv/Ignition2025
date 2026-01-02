<?php

namespace App\Http\Controllers\Magang;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Keahlian;
use App\Models\Lowongan;
use App\Models\Type;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    function lowongan(){
        $lowongans = Lowongan::with('mitra', 'type', 'jenjang', 'keahlian')->get();
        $count = Lowongan::count();
        $types = Type::get();
        $jenjangs = Jenjang::get();
        $keahlians = Keahlian::get();

        return view('Lowongan.index', compact('lowongans', 'count', 'types', 'jenjangs', 'keahlians'));
    }

    function lowonganShow(Lowongan $lowongan){
        $types = Type::get();
        $jenjangs = Jenjang::get();
        $keahlians = Keahlian::get();

        return view('Lowongan.show', compact('lowongan', 'types', 'jenjangs', 'keahlians'));
    }
}