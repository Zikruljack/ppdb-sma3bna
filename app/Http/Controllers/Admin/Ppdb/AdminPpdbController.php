<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbUser;


use App\DataTables\PesertaPPDBDataTable;

class AdminPpdbController extends Controller
{
    // Display a listing of the resource.
    public function index(PesertaPPDBDataTable $dataTables)
    {
        $ppdbs = PpdbUser::all();
        return $dataTables->render('dashboard.ppdb.peserta', compact('ppdbs'));
    }

    //validasi ppdb
    public function validasi($id){
        $ppdb = PpdbUser::find($id);
        $ppdb->status = 'valid';
        $ppdb->save();
        return redirect()->route('admin.ppdb.index');

    }
}
