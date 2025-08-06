<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

/*
| Routes Publiques
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/properties', function () {
    $listings = \App\Models\Listing::where('statut', 'publie')->with(['user', 'bookings'])->get();
    return view('public.listings', compact('listings'));
})->name('properties');

Route::get('/dashboard', [RedirectController::class, 'redirectToDashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

/*
| Routes Admin

*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
    // Gestion des utilisateurs
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
    // Gestion des annonces
    Route::get('/listings', function () {
        return view('admin.listings.index');
    })->name('listings.index');
    // Gestion des réservations
    Route::get('/bookings', function () {
        return view('admin.bookings.index');
    })->name('bookings.index');
    // Analytics
    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('analytics');
    
    // Routes pour les contrôleurs
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('listings', \App\Http\Controllers\ListingController::class);
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);
});

/*
|--------------------------------------------------------------------------
| Routes Host
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'host'])->prefix('host')->name('host.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HostDashboardController::class, 'index'])->name('dashboard');
    // Add more host routes here

    // Gestion des annonces
    Route::get('/listings', function () {
        return view('host.listings.index');
    })->name('listings.index');
    Route::get('/listings/create', function () {
        return view('host.listings.create');
    })->name('listings.create');

    // Gestion des réservations
    Route::get('/bookings', function () {
        return view('host.bookings.index');
    })->name('bookings.index');

    // Calendrier
    Route::get('/calendar', function () {
        return view('host.calendar');
    })->name('calendar');

    // Messages
    Route::get('/messages', function () {
        return view('host.messages');
    })->name('messages');
});

/*
|--------------------------------------------------------------------------
| Routes Client
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ClientDashboardController::class, 'index'])->name('dashboard');
    // Réservations
    Route::get('/bookings', function () {
        return view('client.bookings.index');
    })->name('bookings.index');

    // Messages
    Route::get('/messages', function () {
        return view('client.messages');
    })->name('messages');

    // Favoris
    Route::get('/favorites', function () {
        return view('client.favorites');
    })->name('favorites');
});

/*
| Routes Partagées (Auth)
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes Publiques pour les annonces (visibles par tous)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('listings', \App\Http\Controllers\ListingController::class);
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);
});

require __DIR__ . '/auth.php';
