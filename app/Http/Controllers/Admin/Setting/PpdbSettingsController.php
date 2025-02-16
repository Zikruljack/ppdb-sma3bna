<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\PpdbSetting;


class PpdbSettingsController extends Controller
{
    public function index()
    {
        return view('admin.setting.ppdb.index');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'mulai_pendaftaran' => 'required',
            'akhir_pendaftaran' => 'required',
            'mulai_verifikasi' => 'required',
            'akhir_verifikasi' => 'required',
            'jalur_pendaftaran' => 'required',
            'tanggal_pengumuman' => 'required',
            'kuota' => 'required|integer',
            'maksimal_umur' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $params = $validator->validated();

        try{
            DB::beginTransaction();

            $data = [
                'year' => $request->tahun,
                'start_date' => $request->mulai_pendaftaran,
                'end_date' => $request->akhir_pendaftaran,
                'start_verification' => $request->mulai_verifikasi,
                'end_verification' => $request->akhir_verifikasi,
                'jalur_pendaftaran' => $request->jalur_pendaftaran,
                'announcement_date' => $request->tanggal_pengumuman,
                'quota' => $request->kuota,
                'max_age' => $request->maksimal_umur,
                'status' => $request->status,
            ];

            $setting = PpdbSetting::first();
            if (!$setting) {
                $setting = new PpdbSetting();
            }
            $setting->update($data);

            DB::commit();

            return redirect()->route('admin.setting.ppdb.index')->with('success', 'Data tersimpan');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error saat menyimpan data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
