<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\PpdbSettings;


class PpdbSettingsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query('year', date('Y')); // Default tahun ini
        $settings = PpdbSettings::where('year', $year)->get();

        return view('dashboard.setting.ppdb.index', compact('settings', 'year'));
    }



    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'jalur_pendaftaran' => 'required',
            'kuota' => 'required|integer',
            'mulai_pendaftaran' => 'required|date',
            'waktu_pembukaan' => 'required',
            'akhir_pendaftaran' => 'required|date',
            'waktu_penutupan' => 'required',
            'tanggal_pengumuman' => 'required|date',
            'status' => 'required|boolean',
        ],[
            'jalur_pendaftaran.required' => 'Jalur pendaftaran harus diisi',
            'kuota.required' => 'Kuota harus diisi',
            'mulai_pendaftaran.required' => 'Mulai pendaftaran harus diisi',
            'waktu_pembukaan.required' => 'Waktu pembukaan harus diisi',
            'akhir_pendaftaran.required' => 'Akhir pendaftaran harus diisi',
            'waktu_penutupan.required' => 'Waktu penutupan harus diisi',
            'tanggal_pengumuman.required' => 'Tanggal pengumuman harus diisi',
            'status.required' => 'Status harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $setting = PpdbSettings::firstOrNew(['year' => $request->tahun]);
            $setting->jalur_pendaftaran = $request->jalur_pendaftaran;
            $setting->kuota = $request->kuota;
            $setting->mulai_pendaftaran = $request->mulai_pendaftaran;
            $setting->waktu_pembukaan_ppdb = $request->waktu_pembukaan;
            $setting->akhir_pendaftaran = $request->akhir_pendaftaran;
            $setting->waktu_tutup_ppdb = $request->waktu_penutupan;
            $setting->tanggal_pengumuman = $request->tanggal_pengumuman;
            $setting->status = $request->status;
            $setting->save();

            DB::commit();
            return redirect()->route('admin.ppdb.setting')->with('success', 'Data tersimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
