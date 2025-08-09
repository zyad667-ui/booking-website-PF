<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Models\Listing;

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

Route::get('/recherche', [ListingController::class, 'search'])->name('listings.search');

// Experiences page
Route::get('/experiences', function () {
    $experiences = Listing::where('statut', 'publie')->paginate(12);
    $moroccanProperties = config('images.moroccan_properties');
    return view('experiences', compact('experiences', 'moroccanProperties'));
})->name('experiences');

// API route for dynamic images
Route::get('/api/properties/moroccan', function () {
    return response()->json(config('images.moroccan_properties'));
})->name('api.moroccan.properties');

// API route for Unsplash images
Route::get('/api/images/moroccan', [\App\Http\Controllers\ImageController::class, 'getMoroccanHouses'])
    ->name('api.moroccan.images');

// API route for property images by type
Route::get('/api/images/property/{type}', [\App\Http\Controllers\ImageController::class, 'getPropertyImageByType'])
    ->name('api.property.image');

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
    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('/calendar/events', [\App\Http\Controllers\CalendarController::class, 'getEvents'])->name('calendar.events');
    Route::post('/calendar/booking/status', [\App\Http\Controllers\CalendarController::class, 'updateBookingStatus'])->name('calendar.booking.status');
    Route::post('/calendar/availability', [\App\Http\Controllers\CalendarController::class, 'toggleDateAvailability'])->name('calendar.availability');

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
    
    // Routes pour les messages
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [\App\Http\Controllers\MessageController::class, 'index'])->name('index');
        Route::get('/{conversation}', [\App\Http\Controllers\MessageController::class, 'show'])->name('show');
        Route::post('/', [\App\Http\Controllers\MessageController::class, 'create'])->name('create');
        Route::post('/{conversation}/send', [\App\Http\Controllers\MessageController::class, 'sendMessage'])->name('send');
        Route::post('/{conversation}/read', [\App\Http\Controllers\MessageController::class, 'markAsRead'])->name('read');
        Route::get('/unread/count', [\App\Http\Controllers\MessageController::class, 'getUnreadCount'])->name('unread.count');
        Route::get('/contact/listing/{listing}', [\App\Http\Controllers\MessageController::class, 'contactHost'])->name('contact.listing');
        Route::get('/contact/booking/{booking}', [\App\Http\Controllers\MessageController::class, 'contactBooking'])->name('contact.booking');
    });
});

/*
|--------------------------------------------------------------------------
| Routes Publiques pour les annonces (visibles par tous)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('listings', \App\Http\Controllers\ListingController::class);
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);
    
    // Payment routes
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/booking/{booking}', [\App\Http\Controllers\PaymentController::class, 'showPaymentForm'])->name('create');
        Route::post('/booking/{booking}/intent', [\App\Http\Controllers\PaymentController::class, 'createPaymentIntent'])->name('create-intent');
        Route::post('/confirm', [\App\Http\Controllers\PaymentController::class, 'confirmPayment'])->name('confirm');
        Route::post('/{payment}/cancel', [\App\Http\Controllers\PaymentController::class, 'cancelPayment'])->name('cancel');
        Route::post('/{payment}/refund', [\App\Http\Controllers\PaymentController::class, 'refundPayment'])->name('refund');
        Route::get('/history', [\App\Http\Controllers\PaymentController::class, 'paymentHistory'])->name('history');
        Route::get('/{payment}', [\App\Http\Controllers\PaymentController::class, 'show'])->name('show');
    });
});

// Stripe webhook route (no auth required)
Route::post('/stripe/webhook', [\App\Http\Controllers\StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');

require __DIR__ . '/auth.php';
