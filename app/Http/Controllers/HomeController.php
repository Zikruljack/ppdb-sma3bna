<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PpdbUser;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totalPendaftar = User::role('siswa')->count();
        $totalLengkap = PpdbUser::where('status', '=', 'Final')->count();
        $totalLulus = PpdbUser::where('status', '=', 'Valid')->count();
        $totalPendaftarPrestasi = PpdbUser::where('jalur_pendaftaran', '=', 'prestasi')->where('nisn', '!=', null)->count();
        $totalPendaftarKepemimpinan = PpdbUser::where('jalur_pendaftaran', '=', 'kepemimpinan')->where('nisn', '!=', null)->count();
        $totalSiswaDenganNilai = PpdbUser::where('status', 'Valid')
                                ->whereHas('penilaianPeserta', function ($query) {
                                    $query->whereNotNull('bobot_nilai_rapor')
                                        ->whereNotNull('bobot_nilai_sertifikat')
                                        ->whereNotNull('bobot_nilai_wawancara')
                                        ->whereNotNull('bobot_nilai_baca_quran');
                                })
                                ->count();

        return view('dashboard.index', compact('totalPendaftar', 'totalLengkap', 'totalLulus', 'totalPendaftarPrestasi', 'totalPendaftarKepemimpinan', 'totalSiswaDenganNilai'));
    }
}
