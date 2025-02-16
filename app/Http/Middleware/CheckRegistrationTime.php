<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PpdbSettings;
use Carbon\Carbon;

class CheckRegistrationTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = PpdbSettings::first();
        // dd($setting);

        if (!$setting) {
            return redirect()->route('login')->with('error', 'Pengaturan PPDB belum dikonfigurasi.');
        }

        // Ambil tanggal & waktu saat ini
        $now = Carbon::now();
        $start = Carbon::parse($setting->mulai_pendaftaran . ' ' . $setting->waktu_pembukaan_ppdb);
        $end = Carbon::parse($setting->akhir_pendaftaran . ' ' . $setting->waktu_tutup_ppdb);

        // Periksa apakah pendaftaran sudah dibuka
        if ($now->lt($start) || $now->gt($end)) {
            return redirect()->route('ppdb.index')->with('error', 'Pendaftaran SPMB SMA Negeri 3 Banda Aceh belum dibuka.');
        }
        return $next($request);
    }
}
