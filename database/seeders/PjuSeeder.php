<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pju;
use App\Models\Pju2;
use App\Models\Pju3;
use App\Models\Pju4;
use App\Models\Pju5;

class PjuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        pju::create([
            'daya' => '31.2',
            'arus' => '1',
        ]);
        pju2::create([
            'daya' => '31.2',
            'arus' => '1',
        ]);
        pju3::create([
            'daya' => '31.2',
            'arus' => '1',
        ]);
        pju4::create([
            'daya' => '31.2',
            'arus' => '1',
        ]);
        pju5::create([
            'daya' => '31.2',
            'arus' => '1',
        ]);
        // pju::create([
        //     'daya' => '21.6',
        //     'arus' => '1',
        // ]);
        // pju2::create([
        //     'daya' => '26,2',
        //     'arus' => '1',
        // ]);
        // pju3::create([
        //     'daya' => '34.2',
        //     'arus' => '1',
        // ]);
        // pju4::create([
        //     'daya' => '21.2',
        //     'arus' => '1',
        // ]);
        // pju5::create([
        //     'daya' => '41,2',
        //     'arus' => '1',
        // ]);
        
    }
}