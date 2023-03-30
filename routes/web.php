<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ChauffeursController;
use App\Http\Controllers\VehiculesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\EvaluationsController;
use App\Http\Controllers\PaiementsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Models\Reservation;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('chauffeurs', ChauffeursController::class);
Route::resource('clients', ClientsController::class);
Route::resource('vehicules', VehiculesController::class);
Route::resource('evaluations', EvaluationsController::class);
Route::resource('paiements', PaiementsController::class);
Route::resource('reservations', ReservationsController::class);
Route::get('client/reservations', [ReservationsController::class, 'courseClient'])->name('client.reservations');
Route::get('chauffeur/reservations', [ReservationsController::class, 'courseChauffeur'])->name('chauffeur.reservations');
Route::get('chauffeur/{id_0}/{id_1}/prise_reservation', [ReservationsController::class, 'priseCourseChauffeur'])->name('chauffeur.prendre_reservation');
Route::get('chauffeur/fin_reservation/{id}', [ReservationsController::class, 'finCourseChauffeur'])->name('chauffeur.fin_reservation');
Route::get('chauffeur/{id}/vehicule', [VehiculesController::class, 'vehiculeChauffeur'])->name('chauffeur.vehicule');
Route::get('mon_compte/{id}', [HomeController::class, 'monCompte'])->name('mon_compte');
Route::get('mon_compte/edit/{id}/{type}', [HomeController::class, 'editCompte'])->name('compte.edit');
Route::post('mon_compte/update/{id}/{type}', [HomeController::class, 'updateCompte'])->name('compte.update');

Route::middleware(['auth', 'user-access:client'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


Route::middleware(['auth', 'user-access:admin'])->group(function () {
    
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('/chauffeurs', [ChauffeursController::class, 'index'])->name('chauffeurs.index');
});
  

Route::middleware(['auth', 'user-access:chauffeur'])->group(function () {
  
    Route::get('/chauffeur/home', [HomeController::class, 'chauffeurHome'])->name('chauffeur.home');
});
 
