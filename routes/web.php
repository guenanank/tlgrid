<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthorizationsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ChannelsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Route::middleware('auth')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index']);
    
    Route::resources([
        'applications' => ApplicationsController::class,
        'authorizations' => AuthorizationsController::class,
        'groups' => GroupsController::class,
        'media' => MediaController::class,
        'channels' => ChannelsController::class,
    ]);

    // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// });