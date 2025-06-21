<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Log;

class PjuAllController extends Controller
{
    public function getAllData()
    {
        // Inisialisasi variabel untuk menyimpan total dari masing-masing kolom
        $totalData = [
            'daya' => 0,
            'daya_harian' => 0,
            'profit_harian' => 0,
            'daya_total' => 0,
            'profit_total' => 0,
            'bebas_emisi' => 0,
        ];

        $modelClass = "App\\Models\\Pju";
        if (class_exists($modelClass)) {
            // Mengambil data terakhir dari setiap tabel
            $pjuData = $modelClass::latest()->first();

            if ($pjuData) {
                // Menambahkan nilai dari setiap kolom ke variabel totalData
                $totalData['daya'] += $pjuData->daya ?? 0;
                $totalData['daya_harian'] += $pjuData->daya_harian ?? 0;
                $totalData['profit_harian'] += $pjuData->profit_harian ?? 0;
                $totalData['daya_total'] += $pjuData->daya_total ?? 0;
                $totalData['profit_total'] += $pjuData->profit_total ?? 0;
                $totalData['bebas_emisi'] += $pjuData->bebas_emisi ?? 0;
            }
        }

        // Loop melalui setiap model PJU dan tambahkan nilainya ke total
        for ($i = 2; $i <= 10; $i++) {
            $modelClass = "App\\Models\\Pju$i";

            // Mengecek apakah model class tersebut ada sebelum melanjutkan
            if (class_exists($modelClass)) {
                // Mengambil data terakhir dari setiap tabel
                $pjuData = $modelClass::latest()->first();

                if ($pjuData) {
                    // Menambahkan nilai dari setiap kolom ke variabel totalData
                    $totalData['daya'] += $pjuData->daya ?? 0;
                    $totalData['daya_harian'] += $pjuData->daya_harian ?? 0;
                    $totalData['profit_harian'] += $pjuData->profit_harian ?? 0;
                    $totalData['daya_total'] += $pjuData->daya_total ?? 0;
                    $totalData['profit_total'] += $pjuData->profit_total ?? 0;
                    $totalData['bebas_emisi'] += $pjuData->bebas_emisi ?? 0;
                }
            }
        }

        // Mengembalikan data dalam bentuk JSON
        return response()->json($totalData);
    }

public function getDataGrafikAll()
{
    $dayaHarianData = [];

    // Mengambil data dari Pju1 hingga Pju10
    for ($i = 1; $i <= 10; $i++) {
        $modelClass = "App\\Models\\Pju" . ($i === 1 ? '' : $i);
        
        if (class_exists($modelClass)) {
            $pjuData = $modelClass::whereDate('created_at', '>=', now()->subDays(7))
                                    ->selectRaw('DATE(created_at) as date, daya_harian')
                                    ->orderBy('created_at', 'desc') // Urutan per model
                                    ->get()
                                    ->unique('date'); // Mengambil nilai unik per tanggal

            foreach ($pjuData as $data) {
                $date = $data->date;

                if (!isset($dayaHarianData[$date])) {
                    $dayaHarianData[$date] = $data->daya_harian;
                } else {
                    $dayaHarianData[$date] += $data->daya_harian;
                }
            }
        }
    }

    // **Urutkan berdasarkan tanggal** sebelum dikonversi ke JSON
    ksort($dayaHarianData); // Urutkan berdasarkan key (tanggal)

    // Konversi ke dalam format JSON yang diinginkan
    $result = [];
    foreach ($dayaHarianData as $date => $totalDayaHarian) {
        $result[] = [
            'date' => $date,
            'total_daya_harian' => round($totalDayaHarian, 2)
        ];
    }

    return response()->json($result);
}

    
    
    
    
    
    
    public function collectData()
    {
        Log::info('collectData method called');

        $pjus = [
            Pju::latest()->take(1)->get(),
            Pju2::latest()->take(1)->get(),
            Pju3::latest()->take(1)->get(),
            Pju4::latest()->take(1)->get(),
            Pju5::latest()->take(1)->get(),
            Pju6::latest()->take(1)->get(),
            Pju7::latest()->take(1)->get(),
            Pju8::latest()->take(1)->get(),
            Pju9::latest()->take(1)->get(),
            Pju10::latest()->take(1)->get(),
        ];

        $data = [];
        $totalDaya = 0;
        $totalDayaHarian = 0;
        $profit = 0;
        $dayaTotal = 0;
        $profitTotal = 0;
        $emisi = 0;

        foreach ($pjus as $pju) {
            foreach ($pju as $item) {
                $data[] = [
                    'daya' => $item->daya,
                    'daya_harian' => $item->daya_harian,
                    // 'arus' => $item->arus,
                    'profit_harian' => $item->profit_harian,
                    'daya_total' => $item->daya_total,
                    'bebas_emisi' => $item->bebas_emisi,
                ];
                $totalDaya += $item->daya;
                $totalDayaHarian += $item->daya_harian;
                $profit += $item->profit_harian;
                $dayaTotal += $item->daya_total;
                $profitTotal += $item->profit_total;
                $emisi += $item->bebas_emisi;
            }
        }

        // Debugging: Check the collected data and totalDaya
        Log::debug('Collected data: ', $data);
        Log::debug('Total daya: ' . $totalDaya);
        Log::debug('profit harian: ' . $profit);
        Log::debug('daya total: ' . $dayaTotal);
        Log::debug('profit total: ' . $profitTotal);

        // Prepare the data to be inserted into pju_all
        $dataToInsert = [
            'daya' => $totalDaya,
            'daya_harian' => $totalDayaHarian,
            'profit_harian' => $profit,
            'daya_total' => $dayaTotal,
            'profit_total' => $profitTotal,
            'bebas_emisi' => $emisi,
            // Add other columns as needed
        ];

        try {
            Pju_all::create($dataToInsert);
            Log::info('Data collected and total daya sent to Pju_all table successfully');
            return response()->json(['message' => 'Data collected and total daya sent to Pju_all table', 'daya', 'profit_harian', 'profit_total', 'bebas_emisi'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending data to Pju_all table: ' . $e->getMessage(), [
                'data' => $dataToInsert,
                'exception' => $e,
            ]);
            return response()->json(['message' => 'Error sending data to Pju_all table', 'error' => $e->getMessage()], 500);
        }
    }
}
