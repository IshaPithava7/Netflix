<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PasswordController;


$middlewares = env('IS_ENCRYPTION', false) ? ['auth', 'decrypt.request', 'encrypt.response'] : ['auth'];

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/check-email', 'checkEmail')->name('checkEmail');

    Route::get('/register', 'showRegister')->name('registerPage');
    Route::post('/register', 'register')->name('register');

    Route::get('/login', 'showLogin')->name('loginPage');
    Route::post('/login', 'login')->name('login');

    Route::post('/logout', 'logout')->name('logout');

    Route::get('forgot-password', 'showForgotPassword')->name('password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');

    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('password.reset');
    Route::post('reset-password', 'resetPassword')->name('password.update');
});


/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/
Route::middleware($middlewares)->group(function () {

    Route::view('/email/verify', 'auth.verify-email')
        ->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware($middlewares)->group(function () {

    // Home
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/collections/load-more', [HomeController::class, 'loadMoreCollections']);

    // Profile
    Route::get('/profile', [HomeController::class, 'accountSettings'])->name('accountSettings');
    Route::post('/profiles', [ProfileController::class, 'store']);

    // Account
    Route::delete('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.delete');

    /*
    |--------------------------------------------------------------------------
    | Subscription / Payment
    |--------------------------------------------------------------------------
    */
    Route::prefix('subscription')->name('subscription.')->group(function () {

        Route::get('/', [PaymentController::class, 'show'])->name('index');

        Route::post('/select-plan', [PaymentController::class, 'selectPlan'])->name('select');
        Route::get('/payment/{priceId}', [PaymentController::class, 'showPayment'])->name('payment');

        Route::post('/subscribe', [PaymentController::class, 'subscribe'])->name('subscribe');
        Route::get('/confirm', [PaymentController::class, 'confirmPayment'])->name('confirm');

        Route::patch('/cancel', [PaymentController::class, 'cancelSubscription'])->name('cancel');
    });

    // Support GET for select-plan
    Route::get('/select-plan', function (Request $request) {
        $priceId = $request->query('price_id');

        return $priceId
            ? redirect()->route('subscription.payment', ['priceId' => $priceId])
            : redirect()->route('subscription.index')->withErrors(['price_id' => 'Please select a plan.']);
    })->name('select.plan.get');

    /*
    |--------------------------------------------------------------------------
    | My List
    |--------------------------------------------------------------------------
    */
    Route::prefix('my-list')->name('mylist.')->group(function () {
        Route::post('/toggle', [MyListController::class, 'toggle'])->name('toggle');
        Route::get('/', [MyListController::class, 'mylist'])->name('index');
    });

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    Route::view('/shows', 'home.shows')->name('shows');
    Route::view('/games', 'home.games')->name('games.index');
    Route::get('/new-popular', [\App\Http\Controllers\NewAndPopularController::class, 'NewAndPopular'])->name('newpopular');
    Route::get('/browse-languages', [\App\Http\Controllers\BrowseByLanguageController::class, 'index'])->name('browse.languages');
    Route::get('/movies', [MoviesController::class, 'index'])->name('movies');

    /*
    |--------------------------------------------------------------------------
    | Account Pages
    |--------------------------------------------------------------------------
    */
    Route::prefix('account')->group(function () {
        Route::get('/overview', [AccountController::class, 'overview'])->name('overview');
        Route::get('/membership', [AccountController::class, 'membership'])->name('membership');
        Route::view('/security', 'account.pages.security')->name('security');
        Route::view('/devices', 'account.pages.devices')->name('devices');
        Route::view('/profiles', 'account.pages.profiles')->name('profiles');
    });

    // Password change
    Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.change');

});






