<?php

use App\Http\Controllers\FileManagementSystemController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {

        $results = DB::table('fms')
            ->select(DB::raw("WEEK(created_at) AS week_number, CONCAT(MIN(DATE_FORMAT(created_at, '%Y-%m-%d')), ' - ', DATE_FORMAT(DATE_ADD(MIN(DATE_FORMAT(created_at, '%Y-%m-%d')), INTERVAL 6 DAY), '%Y-%m-%d')) AS week_interval, COUNT(*) AS count"))
            ->where('created_at', '>=', DB::raw("DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 3 WEEK), '%Y-%m-%d')"))
            ->groupBy(DB::raw("WEEK(created_at)"))
            ->orderBy('week_number', 'DESC')
            ->get();

        $weeks = [];
        $categorys = [
            'sphone' => \App\Models\Fms::where('type', 'sphone_snet_br')->count(),
            'sfiber' => \App\Models\Fms::where('type', 'sfiber_br')->count(),
            'rev' => \App\Models\Fms::where('type', 'revenue_br')->count(),
            'rcv' => \App\Models\Fms::where('type', 'recovery_br')->count(),
        ];
        for ($i = 3; $i >= 0; $i--) {
            $week_number = date("W", strtotime("-$i week"));
            $week_count = 0;
            foreach ($results as $result) {
                if ($result->week_number == $week_number) {
                    $week_count = $result->count;
                    break;
                }
            }
            $weeks[$week_number] = $week_count;

        }
        return view('dashboard', compact('weeks','categorys'));
    })->name('dashboard');
    Route::get('/fms', [\App\Http\Controllers\FmsController::class, 'index'])->name('fms.index');
    Route::get('/fms/{fms}', [\App\Http\Controllers\FmsController::class, 'show'])->name('fms.show');

    Route::get('projects', [ProjectsController::class, 'index'])->name('projects.index');
    Route::post('projects/media', [ProjectsController::class, 'storeMedia'])->name('projects.storeMedia');
    Route::post('projects', [ProjectsController::class, 'store'])->name('projects.store');
    Route::delete('projects/{media}/{fms}', [ProjectsController::class, 'destroy'])->name('projects.destroy');
    Route::put('projects/{fms}/update', [ProjectsController::class, 'update'])->name('projects.update');
});
