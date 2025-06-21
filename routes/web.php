<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PjuController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ESPController;
use App\Http\Controllers\LogAkunController; // Corrected: LogAkunController
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\AccountLogController;
use App\Http\Controllers\PjuAllController;
use App\Http\Controllers\HistoriAkunController;
use App\Http\Controllers\PompaController;

Route::get('/pompa-air', [PompaController::class, 'index'])->name('pompa');

Route::post('/pompa-air/esp-data', [PompaController::class, 'espHandler']);


// Route::get('/esp/uploadDaya/{device}/{daya}', 'ESPController@uploadDaya');
Route::get('/collect-data', [PjuAllController::class, 'collectData']);
Route::get('/esp/uploadDaya/{device}/{daya}', 'App\Http\Controllers\ESPController@uploadDaya');
Route::post('/esp/uploadDaya/{device}', [ESPController::class, 'uploadDaya']);
Route::get('/esp/uploadDaya/{device}', [ESPController::class, 'uploadDaya']);


Route::get('/uploadDaya/{daya}', [ESPController::class, 'uploadDaya']);
Route::post('/data', [ESPController::class, 'store']);
Route::post('api/data', [ESPController::class, 'store']);

Route::get('/uploadDaya2/{daya}', [ESPController::class, 'uploadDaya2']);
Route::post('/data2', [ESPController::class, 'store2']);
Route::post('api/data2', [ESPController::class, 'store2']);

Route::get('/uploadDaya3/{daya}', [ESPController::class, 'uploadDaya3']);
Route::post('/data3', [ESPController::class, 'store3']);
Route::post('api/data3', [ESPController::class, 'store3']);

Route::get('/uploadDaya4/{daya}', [ESPController::class, 'uploadDaya4']);
Route::post('/data4', [ESPController::class, 'store4']);
Route::post('api/data4', [ESPController::class, 'store4']);

Route::get('/uploadDaya5/{daya}', [ESPController::class, 'uploadDaya5']);
Route::post('/data5', [ESPController::class, 'store5']);
Route::post('api/data5', [ESPController::class, 'store5']);


Route::middleware(['auth'])->group(function () {
    Route::get('/register-admin', function () {
        return view('auth.register-admin');
    })->name('register-admin');

    Route::post('/register-admin', [AdminRegisterController::class, 'store'])->name('register-admin.store');
});

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/superadmin/dashboard', 'SuperAdminController@dashboard');
Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'superadmin']], function () {
    Route::get('/', [SuperAdminController::class, 'dashboard'])->name('superadmin.index');
    Route::get('/umkm', [SuperAdminController::class, 'umkmIndex'])->name('superadmin.umkm.index');
    Route::get('/galeri', [SuperAdminController::class, 'galeriIndex'])->name('superadmin.galeri.index');
    Route::get('/timer', [SuperAdminController::class, 'timerIndex'])->name('superadmin.timer.index');
    Route::get('/profile/edit', [SuperAdminController::class, 'profileEdit'])->name('superadmin.profile.edit');
    Route::post('/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
    Route::get('/login-logs', [SuperAdminController::class, 'loginLogs'])->name('superadmin.login-logs'); 
});

Route::post('/iot/upload_data', [PjuController::class, 'store'])->name('pju.store');

Route::get('/profil', function () {
    return view('landingpage.profil');
})->name('profil');

Route::get('/layanan', function () {
    return view('landingpage.layanan');
})->name('layanan');

Route::get('/umkm', [UMKMController::class, 'indexGuest'])->name('guest.umkm.index');
Route::get('/umkm/{umkm}', [UMKMController::class, 'show'])->name('guest.umkm.show');

Route::get('/wisata', function () {
    return view('landingpage.wisata');
})->name('wisata');

Route::get('/pju', [PjuController::class, 'index'])->name('pju');
Route::get('/pju/data', [PjuController::class, 'getdata'])->name('pju.getdata');
Route::get('/pju/data1', [PjuController::class, 'getdata1'])->name('pju.getdata1');
Route::get('/pju/data2', [PjuController::class, 'getdata2'])->name('pju.getdata2');
Route::get('/pju/data3', [PjuController::class, 'getdata3'])->name('pju.getdata3');
Route::get('/pju/data4', [PjuController::class, 'getdata4'])->name('pju.getdata4');
Route::get('/pju/data5', [PjuController::class, 'getdata5'])->name('pju.getdata5');
Route::get('/pju/data6', [PjuController::class, 'getdata6'])->name('pju.getdata6');
Route::get('/pju/data7', [PjuController::class, 'getdata7'])->name('pju.getdata7');
Route::get('/pju/data8', [PjuController::class, 'getdata8'])->name('pju.getdata8');
Route::get('/pju/data9', [PjuController::class, 'getdata9'])->name('pju.getdata9');
Route::get('/pju/data10', [PjuController::class, 'getdata10'])->name('pju.getdata10');
Route::get('/pju/dataAll', [PjuController::class, 'getdataAll'])->name('pju.getdataAll');

Route::get('/pju/allData', [PjuAllController::class, 'getAllData'])->name('pju.getAllData');

Route::get('/pju/grafik', [PjuController::class, 'getDayaHarianWeeklyData'])->name('pju.getDayaHarianWeeklyData');
Route::get('/pju/grafik1', [PjuController::class, 'getDayaHarianWeeklyData1'])->name('pju.getDayaHarianWeeklyData1');
Route::get('/pju/grafik2', [PjuController::class, 'getDayaHarianWeeklyData2'])->name('pju.getDayaHarianWeeklyData2');
Route::get('/pju/grafik3', [PjuController::class, 'getDayaHarianWeeklyData3'])->name('pju.getDayaHarianWeeklyData3');
Route::get('/pju/grafik4', [PjuController::class, 'getDayaHarianWeeklyData4'])->name('pju.getDayaHarianWeeklyData4');
Route::get('/pju/grafik5', [PjuController::class, 'getDayaHarianWeeklyData5'])->name('pju.getDayaHarianWeeklyData5');
Route::get('/pju/grafik6', [PjuController::class, 'getDayaHarianWeeklyData6'])->name('pju.getDayaHarianWeeklyData6');
Route::get('/pju/grafik7', [PjuController::class, 'getDayaHarianWeeklyData7'])->name('pju.getDayaHarianWeeklyData7');
Route::get('/pju/grafik8', [PjuController::class, 'getDayaHarianWeeklyData8'])->name('pju.getDayaHarianWeeklyData8');
Route::get('/pju/grafik9', [PjuController::class, 'getDayaHarianWeeklyData9'])->name('pju.getDayaHarianWeeklyData9');
Route::get('/pju/grafik10', [PjuController::class, 'getDayaHarianWeeklyData10'])->name('pju.getDayaHarianWeeklyData10');

Route::get('/pju/grafik/all', [PjuAllController::class, 'getDataGrafikAll'])->name('pju.getDataGrafikAll');

Route::get('/pju/grafikAll', [PjuController::class, 'getDayaHarianWeeklyDataAll'])->name('pju.getDayaHarianWeeklyDataAll');
Route::post('/iot/upload_data', [PjuController::class, 'store'])->name('pju.store');
Route::get('/pju1', [PjuController::class, 'showPju1'])->name('pju1');
Route::get('/pju2', [PjuController::class, 'showPju2'])->name('pju2');
Route::get('/pju3', [PjuController::class, 'showPju3'])->name('pju3');
Route::get('/pju4', [PjuController::class, 'showPju4'])->name('pju4');
Route::get('/pju5', [PjuController::class, 'showPju5'])->name('pju5');
Route::get('/pju6', [PjuController::class, 'showPju6'])->name('pju6');
Route::get('/pju7', [PjuController::class, 'showPju7'])->name('pju7');
Route::get('/pju8', [PjuController::class, 'showPju8'])->name('pju8');
Route::get('/pju9', [PjuController::class, 'showPju9'])->name('pju9');
Route::get('/pju10', [PjuController::class, 'showPju10'])->name('pju10');
Route::get('/pju_all', [PjuController::class, 'showPjuAll'])->name('pju_all');

Route::get('/export-csv', [PjuController::class, 'exportCsv'])->name('export.csv');

Route::get('/timer', [TimerController::class, 'index'])->name('timer.index');
Route::post('/timers/updateCondition', [TimerController::class, 'updateCondition'])->name('timers.updateCondition');
Route::post('/timers', [TimerController::class, 'store'])->name('timers.store');
Route::delete('/timers/{id}', [TimerController::class, 'destroy'])->name('timers.destroy');
Route::post('/timers/updateConditionBasedOnTime', [TimerController::class, 'updateConditionBasedOnTime'])->name('timers.updateConditionBasedOnTime');

Route::get('/galeri', [PhotoController::class, 'indexGuest'])->name('guest.galeri.index');
Route::get('/galeri/{photo}', [PhotoController::class, 'show'])->name('guest.galeri.show');
Route::get('/logakun/create', [LogAkunController::class, 'create'])->name('logakun.create');
Route::post('/logakun', [LogAkunController::class, 'store'])->name('logakun.store');

Route::get('/logakun', [LogAkunController::class, 'index'])->name('logakun.index');
Route::resource('/logakun', LogAkunController::class)->only(['store']); // Corrected: LogAkunController
Route::post('/logakun/create', [LogAkunController::class, 'create'])->name('logakun.create');
Route::post('/logakun/store', [App\Http\Controllers\LogAkunController::class, 'store'])->name('logakun.store');

Route::resource('/logakun', LogAkunController::class)->except(['show']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/logakun', LogAkunController::class)->except(['show', 'create', 'store', 'edit']);
});

Route::get('/logakun', [LoginHistoryController::class, 'index'])->name('logakun.index');
Route::delete('/logakun/destroy', [LoginHistoryController::class, 'destroyAll'])->name('logakun.destroyAll');
Route::get('/historiakun', [HistoriAkunController::class, 'index'])->name('historiakun.index');

Route::delete('/historiakun/destroyAll', [HistoriAkunController::class, 'destroyAll'])->name('historiakun.destroyAll');
Route::get('/historiakun', [HistoriAkunController::class, 'index'])->name('historiakun.index');

Route::middleware(['auth', 'log.login'])->group(function () {
    Route::get('/logakun', [AccountLogController::class, 'index'])->name('logakun.index');
    Route::delete('/logakun', [AccountLogController::class, 'destroyAll'])->name('logakun.destroyAll');
    // Rute yang memerlukan logging login
});


Route::post('/register-admin/store', [RegisterAdminController::class, 'store'])->name('register-admin.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/timer', [TimerController::class, 'index'])->name('timer.index');
    Route::get('/logakun', [LogAkunController::class, 'index'])->name('logakun.index');
    Route::get('/logakun/create', [LogAkunController::class, 'create'])->name('logakun.create');
    Route::post('/register-admin/store', [RegisterAdminController::class, 'store'])->name('register-admin.store');

    Route::resource('/admin/galeri', PhotoController::class)->except(['show']);
    Route::resource('/admin/umkm', UMKMController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
