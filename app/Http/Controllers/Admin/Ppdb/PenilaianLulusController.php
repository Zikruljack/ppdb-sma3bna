<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\PenilaianPeserta;
use App\Models\NilaiRapor;
use App\Models\Mapel;
use App\Models\BerkasPpdb;


class PenilaianLulusController extends Controller
{
    public function index(){
        $penilaian = PenilaianPeserta::all();
        $mapel = Mapel::all();
        $berkasPendukung = BerkasPpdb::all();
        return view('dashboard.ppdb.penilaianlulus', compact('penilaian', 'mapel', 'berkasPendukung'));
    }
}
