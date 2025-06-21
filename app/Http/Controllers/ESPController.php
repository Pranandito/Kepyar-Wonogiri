<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Timer;
use App\Models\Pju;
use App\Models\Pju2;
use App\Models\Pju3;
use App\Models\Pju4;
use App\Models\Pju5;
use App\Models\Pju6;
use App\Models\Pju7;
use App\Models\Pju8;
use App\Models\Pju9;
use App\Models\Pju10;
use App\Models\Pju_all;
use App\Http\Controllers\PjuAllController;
use Carbon\Carbon;

class ESPController extends Controller
{
    private $models = [
        1 => Pju::class,
        2 => Pju2::class,
        3 => Pju3::class,
        4 => Pju4::class,
        5 => Pju5::class,
        6 => Pju6::class,
        7 => Pju7::class,
        8 => Pju8::class,
        9 => Pju9::class,
        10 => Pju10::class,
    ];

    private $tarifListrik = 1352; // Tarif listrik per kWh dalam Rupiah

    public function calculateProfit($daya)
    {
        // Misalkan daya dalam watt, kita konversi ke kilowatt
        $dayaKwh = $daya / 1000;
        // Misalkan pengukuran dilakukan per jam, jadi profit adalah daya dalam kWh dikali tarif listrik
        return $dayaKwh * $this->tarifListrik;
    }

    public function calculateEmisi($daya)
    {
        // Misalkan daya dalam watt, kita konversi ke kilowatt
        $dayaKwh = $daya / 1000;
        // Emisi karbon yang dikurangi konstan 0.85 kg CO2/kWh
        $emisiKarbonDikurangiPerKwh = 0.85; // 0.85 kg CO2/kWh

        return $dayaKwh * $emisiKarbonDikurangiPerKwh;
    }

    public function calculateDayaKeEnergi($daya)  // konversi daya(W) ke daya (Wh)
    {
        $intervalKirim = 2; //data daya dikirim setiap 2 menit
        $energiSaatIni = $daya * $intervalKirim / 60; //60 menit
        return $energiSaatIni;
    }

    public function uploadDaya(Request $request, $device)
    {
        $daya = $request->input('daya');
        $tegangan = $request->input('tegangan');

        if (!is_numeric($daya) || !is_numeric($tegangan)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $model = $this->getModel($device);
        $today = now()->startOfDay();
        $latestRecord = $model::where('created_at', '>=', $today)->latest()->first();
        $latestRecordTotal = $model::latest()->first();
        $totalDayaHarian = $latestRecord ? $latestRecord->daya_harian : 0;
        $totalProfitHarian = $latestRecord ? $latestRecord->profit_harian : 0;

        $energiSaatIni = $this->calculateDayaKeEnergi($daya);
        $statusLampu = $this->statusLampu($device);
        if ($statusLampu == 0) {
            $energiSaatIni = 0;
        };

        $profit = $this->calculateProfit($energiSaatIni);
        $totalDaya = $latestRecordTotal ? $latestRecordTotal->daya_total : 0;
        $totalProfit = $latestRecordTotal ? $latestRecordTotal->profit_total : 0;
        $emisi = $this->calculateEmisi($totalDaya + $energiSaatIni);
        // $emisiTotal = $latestRecordTotal ? $latestRecordTotal->bebas_emisi : 0;
        $pju = $model::create([
            'daya' => $daya,
            'daya_harian' => $totalDayaHarian + $energiSaatIni,
            'tegangan' => $tegangan,
            'profit_harian' => $totalProfitHarian + $profit,
            'daya_total' => $totalDaya + $energiSaatIni,
            'profit_total' => $totalProfit + $profit,
            'bebas_emisi' => $emisi
        ]);

        // Call the collectData method from PjuAllController
        // Tak hapus, hehe
        // $pjuAllController = new PjuAllController();
        // $pjuAllController->collectData();

        return response()->json(
            // 'message' => 'Data received successfully', 
            // 'daya' => $daya, 
            // 'tegangan' => $arus, 
            // 'profit_harian' => $totalProfitHarian + $profit, 
            // 'daya_total' => $totalDaya + $daya, 
            // 'profit_total' => $totalProfit + $profit, 
            // 'bebas_emisi' => $emisiTotal + $emisi], 
            200
        );
    }
    
    public function store(Request $request, $device)
    {
        $daya = $request->input('daya');
        $arus = $request->input('arus');
                
        if (!is_numeric($daya) || !is_numeric($arus)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }
                
        $model = $this->getModel($device);
        $today = now()->startOfDay();
        $latestRecord = $model::where('created_at', '>=', $today)->latest()->first();
        $latestRecordTotal = $model::latest()->first();
        $totalDayaHarian = $latestRecord ? $latestRecord->daya_harian : 0;
        $totalProfitHarian = $latestRecord ? $latestRecord->profit_harian : 0;
        $profit = $this->calculateProfit($daya);
        $totalDaya = $latestRecordTotal ? $latestRecordTotal->daya_total : 0;
        $totalProfit = $latestRecordTotal ? $latestRecordTotal->profit_total : 0;
        $emisi = $this->calculateEmisi($daya);
        $emisiTotal = $latestRecordTotal ? $latestRecordTotal->bebas_emisi : 0;
        $pju = $model::create(['daya' => $daya, 'daya_harian' => $totalDayaHarian + $daya, 'arus' => $arus, 'profit_harian' => $totalProfitHarian + $profit, 'daya_total' => $totalDaya + $daya, 'profit_total' => $totalProfit + $profit, 'bebas_emisi' => $emisiTotal + $emisi]);
                
        // Call the collectData method from PjuAllController
        $pjuAllController = new PjuAllController();
        $pjuAllController->collectData();
        
        return response()->json(['daya' => $daya, 'arus' => $arus, 'profit_harian' => $totalProfitHarian + $profit, 'daya_total' => $totalDaya + $daya, 'profit_total' => $totalProfit + $profit, 'bebas_emisi' => $emisiTotal + $emisi], 200);
    }

    private function getModel($device)
    {
        if (!isset($this->models[$device])) {
            throw new \Exception('Invalid device');
        }
        
        return $this->models[$device];
    }
    
    public function triggerRelay(Request $request)
    {
        // Ambil pju_id dari parameter GET
        $pju_id = $request->query('pju_id', 1); // Default ke 1 jika tidak ada parameter

        // Ambil data untuk pju_id yang diberikan
        $timer = Timer::where('pju_id', $pju_id)->where('status', 'active')->first();
        
        if ($timer) {
            $condition = $timer->condition ? 1 : 0;
            return response()->json(['condition' => $condition], 200);
        }

        return response()->json(['error' => 'Timer not found or inactive'], 404);
    }


    public function getJadwal(Request $request)
    {
        // Ambil pju_id dari parameter GET
        $pju_id = $request->query('pju_id', 6); // Default ke 6 jika tidak ada parameter
    
        // Ambil data untuk pju_id yang diberikan
        $timer = Timer::where('pju_id', $pju_id)->where('status', 'active')->first();
        
        if ($timer) {
            // Ambil waktu sekarang
            $now = Carbon::now();
    
            // Cek apakah sekarang di antara on_time dan off_time
            $on_time = Carbon::parse($timer->on_time);
            $off_time = Carbon::parse($timer->off_time);
    
            $jadwal_on = 0; // Default jadwal tidak nyala
    
            // Jika off_time lebih kecil dari on_time, artinya jadwal melewati tengah malam
            if ($off_time->lt($on_time)) {
                // Cek apakah waktu sekarang lebih besar dari on_time atau kurang dari off_time
                if ($now->gte($on_time) || $now->lte($off_time)) {
                    $jadwal_on = 1; // Set jadwal jadi 1 (nyala)
                }
            } else {
                // Cek apakah waktu sekarang di antara on_time dan off_time
                if ($now->between($on_time, $off_time)) {
                    $jadwal_on = 1; // Set jadwal jadi 1 (nyala)
                }
            }
            
            $condition = $timer->condition ? 1 : 0;
            $jadwal = 0;
            $trigger = $condition && $jadwal_on;
            if($trigger == true){
                $jadwal = 1;
            }else{
                $jadwal = 0;
            }
            
            // Tambahkan jadwal ke dalam response
            return response()->json([
                'jadwal' => $jadwal
            ], 200);
        }
    
        return response()->json(['message' => 'Timer not found'], 404);
    }

    private function statusLampu($request)
    {
        // Ambil data untuk pju_id yang diberikan
        $timer = Timer::where('pju_id', $request)->where('status', 'active')->first();

        if ($timer) {
            // Ambil waktu sekarang
            $now = Carbon::now();

            // Cek apakah sekarang di antara on_time dan off_time
            $on_time = Carbon::parse($timer->on_time);
            $off_time = Carbon::parse($timer->off_time);

            $jadwal_on = 0; // Default jadwal tidak nyala

            // Jika off_time lebih kecil dari on_time, artinya jadwal melewati tengah malam
            if ($off_time->lt($on_time)) {
                // Cek apakah waktu sekarang lebih besar dari on_time atau kurang dari off_time
                if ($now->gte($on_time) || $now->lte($off_time)) {
                    $jadwal_on = 1;
                }
            } else {
                // Cek apakah waktu sekarang di antara on_time dan off_time
                if ($now->between($on_time, $off_time)) {
                    $jadwal_on = 1;
                }
            }

            $condition = $timer->condition ? 1 : 0;
            $statusLampu = 0;
            $trigger = $condition && $jadwal_on;
            if ($trigger == true) {
                $statusLampu = 1;
            } else {
                $statusLampu = 0;
            }

            // Tambahkan jadwal ke dalam response
            return $statusLampu;
        }

        return response()->json(['message' => 'Timer not found'], 404);
    }

}
