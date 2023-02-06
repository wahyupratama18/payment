<?php

use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\ProfileInformationController;
use App\Http\Controllers\API\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function () {
    if (Features::enabled(Features::registration())) {
        Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware(['guest:'.config('fortify.guard')])
        ->name('register');
    }

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

    // if (Features::enabled(Features::resetPasswords())) {
    //     Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    //         ->middleware(['guest:'.config('fortify.guard')])
    //         ->name('password.email');

    //     Route::post('/reset-password', [NewPasswordController::class, 'store'])
    //         ->middleware(['guest:'.config('fortify.guard')])
    //         ->name('password.update');
    // }
});

Route::middleware('auth:sanctum')->group(function () {
    if (Features::enabled(Features::emailVerification())) {
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware([
            config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'),
            'throttle:'.config('fortify.limiters.verification', '6,1'),
        ])
        ->name('verification.send');
    }

    // Profile Information...
    Route::prefix('/user')->group(function () {
        if (Features::enabled(Features::updateProfileInformation())) {
            Route::put('/profile-information', [ProfileInformationController::class, 'update'])
                ->name('user-profile-information.update');
        }

        // Passwords...
        if (Features::enabled(Features::updatePasswords())) {
            Route::put('/password', [PasswordController::class, 'update'])
                ->name('user-password.update');
        }

        Route::get('/', function (Request $request) {
            return $request->user();
        });

        /* Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
            ->name('password.confirm'); */
    });
});
