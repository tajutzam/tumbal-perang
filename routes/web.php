<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\TribeController;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BattleLogController;
use App\Http\Controllers\HomeController;

// ========== AUTH ==========
Auth::routes(['register' => false]);

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// ========== REGISTER ==========
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ========== LEADERBOARD ==========
Route::get('/leaderboard', [LeaderboardController::class, 'index'])
    ->middleware('auth')
    ->name('leaderboard');

// ========== DAILY REWARD ==========
Route::get('/reward', function () {
    return view('reward.index');
})->middleware('auth')->name('reward.page');

Route::get('/reward/claim', [RewardController::class, 'claim'])
    ->middleware('auth')
    ->name('reward.claim');

// ========== PLAYER STATS ==========
Route::get('/stats', [StatsController::class, 'index'])
    ->middleware('auth')
    ->name('stats');

// ========== USER HOME ==========
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// ========== USER PILIH SUKU ==========
Route::middleware('auth')->group(function () {

    Route::get('/choose-tribe', [TribeController::class, 'showChooseTribe'])
        ->name('choose.tribe');

    Route::post('/choose-tribe', [TribeController::class, 'storeTribe'])
        ->name('choose.tribe.store');
});

// ========== USER BUILDINGS ==========
Route::middleware('auth')->group(function () {

    Route::get('/buildings', [BuildingController::class, 'index'])
        ->name('buildings.index');

    Route::post('/buildings/build/{building_id}', [BuildingController::class, 'build'])
        ->name('buildings.build');

    Route::delete('/buildings/{user_building_id}', [BuildingController::class, 'destroy'])
        ->name('buildings.destroy');
});

// ========== ADMIN PANEL ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // TRIBES
    Route::get('/tribes', [TribeController::class, 'adminIndex'])->name('admin.tribes');
    Route::get('/tribes/{id}/edit', [TribeController::class, 'edit'])->name('admin.tribes.edit');
    Route::put('/tribes/{id}', [TribeController::class, 'update'])->name('admin.tribes.update');

    // BUILDINGS
    Route::get('/buildings', [BuildingController::class, 'adminIndex'])->name('admin.buildings');
    Route::get('/buildings/{id}/edit', [BuildingController::class, 'adminEdit'])->name('admin.buildings.edit');
    Route::put('/buildings/{id}', [BuildingController::class, 'adminUpdate'])->name('admin.buildings.update');

    // USERS
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// ========== BATTLE ==========
Route::middleware('auth')->group(function () {
    Route::get('/battle/targets', [BattleController::class, 'targets'])->name('battle.targets');
    Route::get('/battle/attack/{id}', [BattleController::class, 'confirm'])->name('battle.confirm');
    Route::post('/battle/attack/{id}', [BattleController::class, 'attack'])->name('battle.attack');

    Route::get('/battle/logs', [BattleLogController::class, 'index'])->name('battle.logs');
    Route::get('/battle/log/{id}', [BattleLogController::class, 'detail']);
});
