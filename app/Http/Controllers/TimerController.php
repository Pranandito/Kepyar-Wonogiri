<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timer;

class TimerController extends Controller
{
    public function index()
    {
        $timers = Timer::all();
        return view('timer.index', compact('timers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pju_id' => 'required|integer',
            'on_time' => 'required|date_format:H:i',
            'off_time' => 'required|date_format:H:i',
        ]);

        try {
            Timer::updateOrCreate(
                ['pju_id' => $request->pju_id],
                [
                    'on_time' => $request->on_time,
                    'off_time' => $request->off_time,
                ]
            );

            return redirect()->back()->with('success', 'Timer berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error menyimpan timer: ' . $e->getMessage());
        }
    }
    
    public function updateCondition(Request $request)
    {
        $request->validate([
            'pju_id' => 'required|integer',
            'condition' => 'required|boolean',
        ]);

        $timer = Timer::where('pju_id', $request->pju_id)->firstOrFail();
        $timer->condition = $request->condition;
        $timer->save();

        return response()->json([
            'message' => 'Condition updated successfully',
            'condition' => $timer->condition,
        ]);
    }

    public function updateConditionBasedOnTime(Request $request)
    {
        $currentTime = now()->format('H:i:s'); // Ambil waktu saat ini dalam format HH:mm:ss

        $timer = Timer::all();

        foreach ($timer as $timer) {
            $onTime = $timer->on_time;
            $offTime = $timer->off_time;
            $condition = ($currentTime === $onTime) ? 1 : (($currentTime === $offTime) ? 0 : $timer->condition);

            // Update condition di database
            Timer::where('id', $timer->id)->update(['condition' => $condition]);
        }

        return response()->json(['message' => $currentTime]);
    }

}
