<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\SubscriptionPlan;
use Illuminate\Support\Facades\Route;
use Stripe\StripeClient;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/store-image', [HomeController::class, 'storeImage'])->name('store.image');
Route::post('/plan-subscription', [HomeController::class, 'planSubscription'])->name('plan-subscription');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'subscriber.redirect'])->name('dashboard');

Route::get('/subscription-plan', SubscriptionPlan::class)
    ->middleware(['auth', 'non-subscriber.redirect'])
    ->name('subscription-plan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::any('dd', function () {
    $stripe = new StripeClient(config('services.stripe.stripe_secret'));
    $product = $stripe->products->retrieve('prod_PP4I0FBTmgawsm');
    $prices = $stripe->prices->all(['product' => $product->id]);
    dd($prices);
});
