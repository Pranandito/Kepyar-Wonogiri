<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Pompa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class PompaController extends Controller
{
    public function index(){
        $riwayat = $this->riwayatAllTime();
        $aktivitas = $this->riwayatPenggunaan();
        return view('landingpage.pompa', compact('riwayat', 'aktivitas'));
    }

    public function espHandler(Request $request)
    {
        $intervalPengiriman = 2; // 2 menit sekali

        $validated = $request->validate([
            'debit' => 'required|numeric',
            'tegangan_dc' => 'required|numeric',
            'arus_dc' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $daya_dc = $validated['arus_dc'] * $validated['tegangan_dc']; // Watt

        $latestData = Pompa::whereDate('updated_at', Carbon::today())
                ->latest()
                ->first();

        $selisih = $this->selisihWaktu($latestData ? $latestData->updated_at : Carbon::now(), Carbon::now());
        if ($selisih == 0 || $selisih > 5) {
            $selisih = $intervalPengiriman;
        }

        $volume = $validated['debit'] * $selisih; // Liter
        $newVolume = $volume + ($latestData ? $latestData->volume : 0);

        $energiSaatIni = $daya_dc * $selisih / 60; // Watt hour
        $energiHarian = $energiSaatIni + ($latestData ? $latestData->energi_harian : 0);

        $newDurasi = $selisih + ($latestData ? $latestData->durasi_harian : 0); // Menit

        $data = new Pompa();
        $data->debit = $validated['debit']; // L/Menit
        $data->volume = $newVolume; // Liter
        $data->tegangan_dc = $validated['tegangan_dc']; // Volt
        $data->daya_dc = $daya_dc; // Watt
        $data->energi_harian = $energiHarian; // Watt Hour
        $data->durasi_harian = $newDurasi; // Menit

        $latestTotal = Pompa::latest()->first();
        $volumeTotal = $volume + ($latestTotal ? $latestTotal->volume_total : 0);
        $energiTotal = $energiSaatIni + ($latestTotal ? $latestTotal->energi_total : 0);
        $durasiTotal = $selisih + ($latestTotal ? $latestTotal->durasi_total : 0);

        $data->volume_total = $volumeTotal;
        $data->energi_total = $energiTotal;
        $data->durasi_total = $durasiTotal;

        $data->latitude = $validated['latitude'];
        $data->longitude = $validated['longitude'];

        $data->save();

        return response()->json([
            'message' => 'Data telah disimpan',
            'data' => $data
        ], 201);
    }

    public function dataGrafik(){
        $data = Pompa::whereDate('updated_at', Carbon::today())
                    ->select('updated_at', 'volume', 'daya_dc')
                    ->get();
        
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function statistikPompa()
    {
        $dataPompa = Pompa::latest()->first();
        $data = [
            'debit' => (float) $dataPompa->debit,
            'volume' => (float) $dataPompa->volume,
            'tegangan_dc' => (float) $dataPompa->tegangan_dc,
            'daya_dc' => (float) $dataPompa->daya_dc,
            'energi_harian' => (float) $dataPompa->energi_harian,
            'durasi_harian' => (int) $dataPompa->durasi_harian,
            'latitude' => (float) $dataPompa->latitude,
            'longitude' => (float) $dataPompa->longitude,
            'updated_at' => $dataPompa->updated_at,
        ];
    
        return response()->json($data);
    }

    public function riwayatPenggunaan()
    {
        $dates = Pompa::selectRaw('DATE(updated_at) as date')
                    ->orderByDesc('date')
                    ->distinct()
                    ->limit(4)
                    ->pluck('date');

        $data = collect();

        foreach ($dates as $date) {
            $latest = Pompa::whereDate('updated_at', $date)
                        ->orderByDesc('updated_at')
                        ->select('volume', 'durasi_harian', 'energi_harian', 'updated_at')
                        ->first();

            $tanggalParsed = Carbon::parse($latest->updated_at);
            $latest->tanggal = $tanggalParsed->format('d');
            $latest->bulan = $tanggalParsed->format('m');

            if ($latest) {
                $data->push($latest);
            }
        }

        return $data;
    }

    private function riwayatAllTime()
    {
        App::setLocale('id');
        Carbon::setLocale('id');

        $dataPompa = Pompa::latest()->first();
        $energi = $dataPompa->energi_total;
        $tanggal = Carbon::parse($dataPompa->updated_at);
        $durasi = CarbonInterval::minutes((int) $dataPompa->durasi_total)->cascade();


        $data = [
            'volume_total' => (float) $dataPompa->volume_total,
            'energi_total' => (float) $energi,
            'penghematan_total' => round($energi * 1.4447, 0),
            'emisi_total' => round($energi * 0.00085, 2),
            'jam_total' => $durasi->hours,
            'menit_total' => $durasi->minutes,
            'tanggal' => $tanggal->format('d'),
            'bulan' => $tanggal->translatedFormat('F'),
            'tahun' => $tanggal->translatedFormat('Y'),
        ];
    
        return $data;
    }

    public function tesser(){
        $shit = $this->riwayatAllTime();
        $shot = $this->riwayatPenggunaan();
        $hari = $shot[0]['volume'];
        return response()->json($shot);
    }

    private function selisihWaktu($sebelum, $sekarang){
        $sebelumParsed = Carbon::parse($sebelum);
        $sekarangParsed = Carbon::parse($sekarang);

        $selisihMenit = $sekarangParsed->diffInMinutes($sebelumParsed);
        $selisihDetik = $sekarangParsed->diffInSeconds($sebelumParsed);

        $selisih = $selisihMenit + ($selisihDetik/60);

        return $selisih;
    }
}
