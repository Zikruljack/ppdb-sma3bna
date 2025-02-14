<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\PpdbUser;
use App\Models\NilaiRapor;

use App\DataTables\PesertaPPDBDataTable;

class AdminPpdbController extends Controller
{
    // Display a listing of the resource.
    public function index(PesertaPPDBDataTable $dataTables)
    {
        $ppdbs = PpdbUser::all();
        return $dataTables->render('dashboard.ppdb.peserta', compact('ppdbs'));
    }

    public function detailPeserta($id = null){
        $user = auth()->user();

        $data = PpdbUser::where('status', 'Final')->where('id', $id)->first();
        $nilaiRapor = NilaiRapor::where('user_id', $user->id)
                    ->with('mapel')
                    ->orderBy('semester')
                    ->get()
                    ->groupBy('semester');
        $pdf = PDF::loadView('dashboard.ppdb.pdf', compact('data', 'nilaiRapor'));

        // return view('dashboard.ppdb.pdf', compact('userPpdb'));
        return $pdf->stream('formulir-ppdb.pdf');
    }

    //validasi ppdb
    public function validasi($id){
        $ppdb = PpdbUser::find($id);
        $ppdb->status = 'valid';
        $ppdb->save();
        return redirect()->route('admin.ppdb.index');

    }

}
